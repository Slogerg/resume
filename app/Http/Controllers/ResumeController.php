<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeRequest;
use App\Models\Resume;
use App\Repository\ResumeRepository;

use Illuminate\Http\Request;

class ResumeController extends Controller
{
    private $resumeRepository;

    public function __construct(ResumeRepository $resumeRepository)
    {
        $this->resumeRepository = $resumeRepository;
    }

    public function index()
    {
        $paginator = $this->resumeRepository->getPaginate();
        return view('resume.index',compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resume.admin.add_resume');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResumeRequest $request)
    {

        $data = $request->input();

        if($request->file('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = $path;
        }

        $result = Resume::create($data);
        if ($result)
            return redirect()->route('resume.index');
    }


    public function searchName(Request $request)
    {
        $search = $request->input('searchName');
        $paginator = Resume::query()->where('name','LIKE',"%{$search}%")->orderBy('name')->paginate(10);
        return view('resume.index',compact('paginator'));
    }

    public function orderOld()
    {
        $paginator = Resume::query()->orderBy('created_at')->paginate(10);
        return view('resume.index',compact('paginator'));
    }

    public function orderNew()
    {
        $paginator = Resume::query()->orderByDesc('created_at')->paginate(10);
        return view('resume.index',compact('paginator'));
    }

    public function searchDate(Request $request)
    {
        $search = $request->input('searchDate');
        $paginator = Resume::query()->where('created_at','LIKE',"%{$search}%")->orderByDesc('created_at')->paginate(10);
        return view('resume.index',compact('paginator'));
    }
}
