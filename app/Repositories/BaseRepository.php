<?php   

namespace App\Repositories;   

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseRepository
{     

    protected $model;       

    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }

    public function index(Request $request = null)
    {
        return $this->model->all();
    }
 
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }
 
    public function update($id, array $attributes): Model
    {
        $user = $this->find($id);

        $user->fill($attributes);

        $user->save();

        return $user;
    }

    public function find($id): ?Model
    {        
        return $this->model->find($id);
    }

    public function findBy($field, $value)
    {
        return $this->model->where($field, $value);
    }
    
    public function insert($data)
    {
        return $this->model->insert($data);
    }

    public function getModel()
    {
        return $this->model;
    }
}