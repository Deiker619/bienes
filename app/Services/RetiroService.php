<?php

namespace App\Services;

use App\Models\retiro;


class RetiroService
{
    
    public function deleteRetiro($id)
    {
        $retiro = retiro::find($id);
        if ($retiro) {
            $retiro->delete();
            return true;
        } else {
            return false;
        }
    }
    public function exportRetiroWithNote($id)
    {
        redirect()->route('pdf_with_nota', ['id' => $id]);
    }
}
