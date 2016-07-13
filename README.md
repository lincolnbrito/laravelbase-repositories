# Laravel Base Repositories

## Usage

Structure (proposal)
```
   Domain
   |__Models
   |   |__Person.php
   |__Repositories
      |__Criterias
      |   |__Age.php
      |__PersonRepository.php
```

Model 
```php
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people';
}
```

Repository
```
use LincolnBrito\LaravelBaseRepositories\Eloquent\Repository;

class Person Repository extends Repository
{
    //default fields
    protected $fields = ['name','age','state'];

    public function model()
    {
        return Person::class;
    }
}
```

Criteria
```
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class Age extends Criteria {
    /** @var  string */
    protected $fill = ['age'];

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository) {
        $query = $model->where('age','>=', "%{$this->age}%");                       
        return $query;
    }
}
```

### Pushing criterias

Get param from request
```
   $this->pessoaRepository->pushCriteria(new Age($request->all()));    
```

OR

Pass param
```
   $this->pessoaRepository->pushCriteria(new Age(["age"=>18]));    
```


## Todo
- [ ] Load criteria automatically based on request
- [ ] Implement unit tests 