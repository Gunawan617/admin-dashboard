<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }
        $book = Book::create($data);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view('admin.book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, string $id)
    {
        $book = Book::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama jika ada
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }
        $book->update($data);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }

    // API Methods
    public function indexApi()
    {
        $books = Book::all();
        return response()->json([
            'success' => true,
            'data' => $books
        ]);
    }

    public function showApi(string $id)
    {
        $book = Book::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }

    public function storeApi(StoreBookRequest $request)
    {
        try {
            $data = $request->validated();
            
            // Set default values for required fields
            $data['category'] = $data['category'] ?? 'General';
            $data['excerpt'] = $data['excerpt'] ?? 'No excerpt available';
            $data['description'] = $data['description'] ?? 'No description available';
            $data['price'] = $data['price'] ?? '0';
            
            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
            }
            
            $book = Book::create($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Book created successfully',
                'data' => $book
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateApi(UpdateBookRequest $request, string $id)
    {
        try {
            $book = Book::findOrFail($id);
            $data = $request->validated();
            
            // Set default values for required fields if not provided
            $data['category'] = $data['category'] ?? $book->category;
            $data['excerpt'] = $data['excerpt'] ?? $book->excerpt;
            $data['description'] = $data['description'] ?? $book->description;
            $data['price'] = $data['price'] ?? $book->price;
            
            if ($request->hasFile('cover_image')) {
                // Hapus gambar lama jika ada
                if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                    Storage::disk('public')->delete($book->cover_image);
                }
                $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
            }
            
            $book->update($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Book updated successfully',
                'data' => $book
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroyApi(string $id)
    {
        try {
            $book = Book::findOrFail($id);
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $book->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Book deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete book',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
