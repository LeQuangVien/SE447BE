<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(Request $request)
    {
        $report = Contact::create([
            'ho_va_ten'     => $request->ho_va_ten,
            'email'          => $request->email,
            'tieu_de'     => $request->tieu_de,
            'content'     => $request->content,
        ]);
        if ($report) {
            return response()->json([
                'status'   => true,
                'message'  => 'Đã Gửi Thành Công'
            ]);
        } else {
            return response()->json([
                'status'   => false,
                'message'  => 'Gửi Thất Bại'
            ]);
        }
    }


    public function store()
    {
        $data = Contact::get();
        return response()->json([
            'data'     => $data
        ]);
    }
}
