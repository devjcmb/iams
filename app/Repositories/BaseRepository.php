<?php   

namespace App\Repositories;   

use Illuminate\Database\Eloquent\Model;   

class BaseRepository
{     

    protected $model;       

    public function __construct(Model $model)     
    {         
        $this->model = $model;
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
}