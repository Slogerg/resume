<?php


namespace App\Repository;


use App\Models\Resume;

class ResumeRepository
{

    public function getPaginate()
    {
        return Resume::paginate(10);
    }

}
