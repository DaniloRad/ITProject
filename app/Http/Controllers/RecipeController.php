<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::where('active', true)->paginate(5);
        return view('admin.recipes.index', compact('recipes'));
    }

    public function addRecipe(Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'required|mimes:jpg,jpeg,png',
            'text' => 'required|string|max:2000',
            'ingredients' => 'required|string|max:2000',
            'steps' => 'required|string|max:2000',
            'diff' => 'required'          
        ]);

        $recipe = new Recipe;
        $recipe->name = $request->name;
        $recipe->text = $request->text;
        $recipe->ingredients = $request->ingredients;
        $recipe->steps = $request->steps;
        $recipe->difficulty = $request->diff;

        if (request()->hasFile('image')) {
            $destinationPath = '/images/recipe/';
            $imageName = request()->file('image')->getClientOriginalName();
            $filenameCover = time() . str_replace(' ', '_', $imageName);;
            request()->file('image')->move(public_path() . $destinationPath, $filenameCover);
            $recipe->image_url = $destinationPath . $filenameCover;
        }

        $recipe->save();
        return response('success', 200);
    }

    public function delete($id) {

        if($id != '' && $id != null) {
            $recipe = Recipe::findOrFail($id)->update(['active' => false]);
            return redirect()->back();
        } else {
            abort(404, 'ID recepta nije validan!');
        }
    }


    public function editRecipe($id) {

        if($id != '' && $id != null) {
            $recipe = Recipe::findOrFail($id);
            return view('admin.recipes.edit', compact('recipe'));
        } else {
            abort(404, 'ID recepta nije validan!');
        }
    }


    public function updateRecipe(Request $request) {

        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string|max:100',
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'description' => 'required|string|max:2000',
            'ingredients' => 'required|string|max:2000',
            'steps' => 'required|string|max:2000',
            'diff' => 'required'          
        ]);

        $recipe = Recipe::findOrFail($request->id);
        $recipe->name = $request->name;
        $recipe->text = $request->description;
        $recipe->ingredients = $request->ingredients;
        $recipe->steps = $request->steps;
        $recipe->difficulty = $request->diff;

        if (request()->hasFile('image')) {
            $destinationPath = '/images/recipe/';
            $imageName = request()->file('image')->getClientOriginalName();
            $filenameCover = time() . str_replace(' ', '_', $imageName);;
            request()->file('image')->move(public_path() . $destinationPath, $filenameCover);
            $recipe->image_url = $destinationPath . $filenameCover;
        }

        $recipe->save();
        return redirect('my-recipes');   
    }
}
