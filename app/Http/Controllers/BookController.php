<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function getRecommendations(Request $request)
    {
        // Implementar a lógica para buscar recomendações
        // Retornar uma resposta JSON com as recomendações
    }

    public function searchBooks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'author' => 'string|max:255',
            'isbn' => 'string|max:255',
            'genre' => 'string|max:255',
            'publication_year' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $query = Book::with(['author', 'genres']);

        if ($request->has('title')) 
            $query->where('title', 'like', '%' . $request->input('title') . '%');

        if ($request->has('author')) {
            $query->whereHas('author', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('author') . '%');
            });
        }

        if ($request->has('isbn')) 
            $query->where('isbn', $request->input('isbn'));

        if ($request->has('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('genre') . '%');
            });
        }

        if ($request->has('publication_year')) 
            $query->where('publication_year', $request->input('publication_year'));

        $books = $query->paginate(10);

        return response()->json($books);
    }

    public function rateBook(Request $request)
    {
        // Implementar a lógica para avaliar um livro
        // Retornar uma resposta confirmando a avaliação
    }

    public function bookDetails($id)
    {
        $book = Book::with(['author', 'genres', 'ratings'])->find($id);

        if (!$book)
            return response()->json(['message' => 'Livro não encontrado.'], 404);
        return response()->json($book);
    }

    public function newReleases()
    {
        $currentYear = now()->year;
        $newReleases = Book::where('publication_year', $currentYear)->get();
        return response()->json($newReleases);
    }

    public function trendingBooks(Request $request)
    {
        // Implementar a lógica para listar livros em tendência
        // Retornar uma resposta JSON com os livros em tendência
    }

    public function authorInfo($authorId)
    {
        $author = Author::with('books')->find($authorId);
        
        if (!$author)
            return response()->json(['message' => 'Autor não encontrado.'], 404);
        return response()->json($author);
    }

    public function popularGenres(Request $request)
    {
        // Implementar a lógica para listar gêneros populares
        // Retornar uma resposta JSON com os gêneros populares
    }
}
