<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bluphant\BluphantAdapter;
use Bluphant\Interfaces\DatabaseAdapterInterface;
use App\Model\Mapper\NoteMapper;

class NoteController extends Controller
{
    /**
     * @var DatabaseAdapterInterface
     */
    protected $adapter;

    /**
     * @var string
     */
    protected $table;

    /**
     * @internal This is a temporary solution
     */
    public function __construct() 
    {
        $this->adapter = new BluphantAdapter(
            config('database.connections.bluphant.host'),
            config('database.connections.bluphant.port')
        );

        // TODO: move this logic to NoteMapper
        // $noteMapper = new NoteMapper($this->adapter);

        $this->table = config('database.connections.bluphant.address_base') . "-notes";
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notes = json_decode(
            $this->adapter->keys($this->table)->execute(),
            true
        );

        $notes_array = [];
        foreach ($notes['data']['keys'] as $key => $value) {
            $notes_array[$key] = json_decode(
                $this->adapter->select($this->table, ['key' => $value])->execute(),
                true
            )['data'];
        }

        $notes_array = array_map(function($item){
            $data = json_decode($item['value'], true);
            return [
                'key' => $item['key'],
                'title' => $data['title'],
                'content' => $data['content']
            ];
        }, $notes_array);

        return view('notes/notes-list', [
            'notes' => $notes_array
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $next_note_key = json_decode(
            $this->adapter->keys($this->table)->execute(),
            true
        )['data']['keys'];

        if (empty($next_note_key)) {
            $next_note_key = 1;
        } else {
            $next_note_key = max($next_note_key) + 1;
        }

        return view('notes/notes-create', [
            'next_note_key' => $next_note_key
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_note = [
            'key' => $request->input('key'), 
            'value' => json_encode([
                'title' => $request->input('title'), 
                'content' => $request->input('content')
            ]) 
        ];

        $result = $this->adapter->insert($this->table, $new_note)->execute();

        if( isset(json_decode($result, true)['request-id']) ) {
            return redirect('notes/' . $request->input('key'));
        }

        return redirect('notes');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $key
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        $note = json_decode(
            $this->adapter->select($this->table, ['key' => $key])->execute(),
            true
        )['data'];

        $note_value = json_decode($note['value'], true);

        $note = [
            'key' => $note['key'],
            'title' => $note_value['title'],
            'content' => $note_value['content']
        ];

        return view('notes/notes-view', [
            'note' => $note
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $key
     * @return \Illuminate\Http\Response
     */
    public function edit($key)
    {
        $note = json_decode(
            $this->adapter->select($this->table, ['key' => $key])->execute(),
            true
        )['data'];

        $note_value = json_decode($note['value'], true);

        $note = [
            'key' => $note['key'],
            'title' => $note_value['title'],
            'content' => $note_value['content']
        ];

        return view('notes/notes-edit', [
            'note' => $note
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $key
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $key)
    {
        $form_data = $request->input();

        $note = [
            'key' => $key,
            'value' => json_encode([
                'title' => $form_data['title'],
                'content' => $form_data['content']
            ])
        ];

        $result = $this->adapter->update($this->table, $note)->execute();

        if( isset(json_decode($result, true)['request-id']) ) {
            return redirect('notes/' . $key);
        }

        return redirect('notes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
        $result = $this->adapter->delete($this->table, ['key' => $key])->execute();

        return redirect('notes');
    }
}
