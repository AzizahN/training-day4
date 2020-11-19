<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Liveware\Component;

class FormBlog extends Component
{
    public $action;
    public $data;
    public $dataId;

    protected function getRules(){
      if ($this->action="create"){
        $rules=[
          'data.title' => 'requiredmax:256',
          'data.content' => 'required',
          'data.thumbnail' => 'required'
        ];
      }
      else {
        $rules=[
          'data.title' => 'requiredmax:256',
          'data.content' => 'required',
        ];
        // code...
      }
      return $rules;
    }

    public function mount(){
      if (!!$this->dataId){
        $this->data=Blog::findOrFail($this->dataId);
      }
    }

    public function create(){
      $this->resetErrorBag();
      $this->validate();
      $this->data['slug']=Str::slug($this->data['title'])();
      $this->data['thumbnail'=md5($this->data['title']).'.'.$this->data['thumbnail-photo']->getClientOriginalExtension();
      $this->data['thumbnail-photo']->storeAs('public/blog',$this->data['thumbnail']);
      Blog::create($this->data);

      $this->emit('saved');
    }

    public function render(){

    }
}
