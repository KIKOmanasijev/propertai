<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use OpenAI\Client;
use Spatie\MediaLibrary\MediaCollections\FileAdder;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render(
            'Property/Index',
            [ 'properties' => auth()->user()->properties ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Property/Create',
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        // Create a Property without a description
        $property = auth()->user()->properties()->create([
            'location' => $request->get('location')
        ]);

        // Upload images and map them into a valid OpenAi Chat payload format
        $images = collect($property->addMultipleMediaFromRequest(['images']))
            ->map(function (FileAdder $file){
                $media = $file->toMediaCollection();

                return [
                    'type' => 'image_url',
                    'image_url' => [
                        'url' => $media->getTemporaryUrl(Carbon::now()->addDay())
                    ]
                ];
            })->merge([[
                'type' => 'text',
                'text' => sprintf('Write me a beautiful and catchy property description. The property is located in %s, and here are a couple of images from it.The length of the text must be at least 300 words. The output must be wrapped in a <div> format, and needs to have a couple of H2 headings.', $request->get('location', 'Florida'))
            ]])->reverse()->values();

        // Create description for the property
        $description = $client->chat()->create([
            'model' => 'gpt-4-vision-preview',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an AirBnb property owner. Your job is to write beautiful property descriptions that will catch visitors attention, and potentially make them rent your property. To do so, your description needs to be catchy and well-written.'
                ],
                [
                    'role' => 'user',
                    'content' => $images->toArray()
                ]
            ],
            'max_tokens' => 2000
        ])->choices[0]->message->content;

        $property->description = $description;
        $property->save();

        return redirect()->route('properties.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return Inertia::render(
            'Property/Show',
            [ 'property' => $property->append('images') ]
        );
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->back();
    }
}
