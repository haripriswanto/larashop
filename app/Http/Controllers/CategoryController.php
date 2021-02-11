<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('staff-access')) return $next($request);

            abort(403, 'Maaf, Hak akses anda dibatasi !');
        });
    }


    public function index(Request $request)
    {
        $category = Category::paginate(10);
        $title = "Manage Category";

        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $category = Category::WHERE("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }


        return view('pages.category.index', ['categories' => $category, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Manage Category";

        return view('pages.category.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        \Validator::make($request->all(), [
            "name" => "required|min:3|max:50",
            "image" => "required",
        ])->validate();

        $name = $request->get('name');

        $new_category = new Category;
        $new_category->name = $name;

        if ($request->file('image')) {
            $image_path = $request->file('image')
                ->store('categories_images', 'public');

            $new_category->image = $image_path;
        }
        $new_category->created_by = \Auth::user()->id;
        $new_category->slug = \Str::slug($name, '-');

        $new_category->save();

        return redirect()->route('categories.index')->with('status', 'Berhasil Menambahkan kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('pages.category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $title = "Edit Category";
        return view('pages.category.edit', ['category' => $category, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required|min:3|max:50",
            "image" => "required",
            "slug" => [
                "required",
                Rule::unique("categories")->ignore($category->slug, "slug")
            ]
        ])->validate();

        $name = $request->get('name');
        $slug = $request->get('slug');


        $category->name = $name;
        $category->slug = $slug;

        if ($request->file('image')) {
            if ($category->image && file_exists(storage_path('app/public/' . $category->image))) {
                \Storage::delete('public/' . $category->name);
            }
            $new_image = $request->file('image')->store('category_image', 'public');
            $category->image = $new_image;
        }

        $category->updated_by = \Auth::user()->id;
        $category->slug = \Str::slug($name);
        $category->save();

        return redirect()->route('categories.index')->with('status', 'Berhasil Perbarui data Kategori ' . $name);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.trash')->with('status', 'Berhasil Pindahkan data ke Folder Sampah');
    }

    public function trash()
    {
        $deleted_category = Category::onlyTrashed()->paginate(10);
        $title = "Trashed Category";

        return view('pages.category.trashed', ['categories' => $deleted_category, 'title' => $title]);
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        if ($category->trashed()) {
            $category->restore();
        } else {
            return redirect()->route('categories.index')->with('status', 'Kategori ' . $category->name . ' tidak ada di folder trash');
        }
        return redirect()->route('categories.index')->with('status', 'Berhasil Restore Kategori ' . $category->name);
    }

    public function deletePermanent($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        if (!$category->trashed()) {
            return redirect()->route('categories.index')->with('status', 'tidak bisa menghapus kategori aktif !');
        } else {
            $category->forceDelete();

            return redirect()->route('categories.trash')->with('status', 'Berhasil Menghapus permanent kategori ' . $category->name);
        }
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $categories = Category::where('name', 'LIKE', "%$keyword%")->get();

        return $categories;
    }
}
