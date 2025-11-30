<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->orderBy('category')->orderBy('created_at')->get();
        return view('faq.index', compact('faqs'));
    }

    public function staffIndex()
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can access this page.');
        }

        $faqs = Faq::orderBy('order')->orderBy('category')->orderBy('created_at')->get();
        return view('staff.faqs', compact('faqs'));
    }

    public function create()
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can create FAQs.');
        }

        return view('staff.faqs.create');
    }

    public function store(Request $request)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can create FAQs.');
        }

        $validated = $request->validate([
            'category' => ['required', 'string', 'max:255'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        try {
            Faq::create([
                'id' => (string) Str::uuid(),
                'category' => $validated['category'],
                'question' => $validated['question'],
                'answer' => $validated['answer'],
                'order' => $validated['order'] ?? 0,
            ]);

            return redirect()->route('staff.faqs')
                ->with('success', 'FAQ created successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to create FAQ: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Failed to create FAQ. Please try again.']);
        }
    }

    public function edit($id)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can edit FAQs.');
        }

        try {
            $faq = Faq::findOrFail($id);
            return view('staff.faqs.edit', compact('faq'));
        } catch (\Exception $e) {
            abort(404, 'FAQ not found');
        }
    }

    public function update(Request $request, $id)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can update FAQs.');
        }

        $validated = $request->validate([
            'category' => ['required', 'string', 'max:255'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        try {
            $faq = Faq::findOrFail($id);
            
            $faq->update([
                'category' => $validated['category'],
                'question' => $validated['question'],
                'answer' => $validated['answer'],
                'order' => $validated['order'] ?? 0,
            ]);

            return redirect()->route('staff.faqs')
                ->with('success', 'FAQ updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to update FAQ: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['message' => 'Failed to update FAQ. Please try again.']);
        }
    }

    public function destroy($id)
    {
        if (!session('user') || !in_array(session('user')['role'] ?? '', ['employee', 'admin'])) {
            abort(403, 'Only staff members can delete FAQs.');
        }

        try {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return redirect()->route('staff.faqs')
                ->with('success', 'FAQ deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to delete FAQ: ' . $e->getMessage());
            
            return redirect()->back()
                ->withErrors(['message' => 'Failed to delete FAQ. Please try again.']);
        }
    }
}
