<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        $title = "Manage Book";

        if ($status) {
            $book = Book::with('categories')->where('title', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        } else {
            $book = Book::with('categories')->where('title', "LIKE", "%$keyword%")->paginate(10);
        }

        return view('pages.book.index', ['books' => $book, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Manage Book";

        return view('pages.book.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_book = new Book;

        $new_book->title = $request->get('title');
        $new_book->description = $request->get('description');
        $new_book->author = $request->get('author');
        $new_book->publisher = $request->get('publisher');
        // $new_book->cover = $request->get('image');
        $new_book->price = $request->get('price');
        $new_book->stock = $request->get('stock');
        $new_book->status = $request->get('save');

        $cover = $request->file('image');

        if ($cover) {
            $cover_path = $cover->store('book-covers', 'public');

            $new_book->cover = $cover_path;
        }

        $new_book->slug = \Str::slug($request->get('title'));
        $new_book->created_by = \Auth::user()->id;

        // dd($cover);
        $new_book->save();
        $new_book->categories()->attach($request->get('categories'));

        if ($request->get('save') == 'PUBLISH') {
            return redirect()->route('books.create')->with('status', 'Berhasil Simpan dan Publish');
        }

        return redirect()->route('books.create')->with('status', 'Berhasil Simpan Sebagai Draft');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $title = "Manage Book";

        return view('pages.book.show', ['book' => $book, 'title' => $title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $title = "Manage Book";
        return view('pages.book.edit', ['book' => $book, 'title' => $title]);
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
        $book = Book::findOrFail($id);

        $book->title = $request->get('title');
        $book->slug = $request->get('slug');
        $book->description = $request->get('description');
        $book->author = $request->get('author');
        $book->publisher = $request->get('publisher');
        $book->stock = $request->get('stock');
        $book->price = $request->get('price');

        $new_cover = $request->file('image');

        if ($new_cover) {
            if ($book->cover && file_exists(storage_path('app/public' . $book->cover))) {
                \Storage::delete('public/' . $book->cover);
            }
            $new_cover_path = $new_cover->store('book-covers', 'public');

            $book->cover = $new_cover_path;
        }

        $book->updated_by = \Auth::user()->id;
        $book->status = $request->get('status');

        $book->save();
        $book->categories()->sync($request->get('categories'));

        return redirect()->route('books.index', [$book->id])->with('status', 'Berhasil Update Buku ' . $book->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('status', 'Data moved to Trash');
    }

    public function trash()
    {
        $books = Book::onlyTrashed()->paginate(10);
        $title = 'Manage Book';

        return view('pages.book.trashed', ['books' => $books, 'title' => $title]);
    }

    public function restore($id)
    {
        $books = Book::withTrashed()->findOrFail($id);

        if ($books->trashed()) {

            $books->restore();
            return redirect()->route('books.trash')->with('status', 'Berhasil Restore Data' . $books->title);
        } else {

            return redirect()->route('books.trash')->with('status', 'Buku tidak ada di tabel trash');
        }
    }

    public function deletePermanent($id)
    {
        $books = Book::withTrashed()->findOrFail($id);

        if (!$books->trashed()) {

            return redirect()->route('books.trash')->with('status', 'Data tidak ada di tabel trash')->with('status_type', 'alert');
        } else {

            $books->categories()->detach();
            $books->forceDelete();

            return redirect()->route('books.trash')->with('status', 'Berhasil hapus Permanen data ' . $books->title);
        }
    }
}
