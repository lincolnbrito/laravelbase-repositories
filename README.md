# Laravel Base Repositories

## Usage

Structure (proposal)
```
   Domain
   |
   |__Dto
   |  |
   |  |__PersonSearch.php
   |
   |__Models
   |   |__Person.php
   |
   |__Repositories
      |  
      |__Criterias
      |   |
      |   |__Age.php
      |
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
```php
use LincolnBrito\LaravelBaseRepositories\Eloquent\Repository;

class Person Repository extends Repository
{
    //fields to return on query
    protected $fields = ['name','age','state'];

    //model class
    public function model()
    {
        return Person::class;
    }
}
```

Criterias

*Age*
```php
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class Age extends Criteria
{
    //wich values the criteria will store
    protected $fill = ['age','name'];

    public function apply($model, Repository $repository) {
        $query = $model->where('age','>=', $this->age);                       
        return $query;
    }
}
```

*Name*
```php
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class Name extends Criteria
{
    protected $fill = ['name'];

    public function apply($model, Repository $repository) {
        $query = $model->where('name','LIKE', "%{$this->age}%");                       
        return $query;
    }
}
```

Search
```php
use LincolnBrito\LaravelBaseRepositories\Search\Search;

class PersonSearch extends Search {
    //control which param are used to search
    protected $fill = ['name','age'];
}
```


### Pushing criterias

Get param from request
```php
   $this->personRepository->pushCriteria(new Age($request->all()));    
```

OR

Pass param
```php
   $this->personRepository->pushCriteria(new Age(["age"=>18]));    
```


### Filter

```php
    
    //Laravel DI
    public function __construct(PersonRepository $personRepository, PersonSearch $search){
        $this->personRepository = $personRepository;
        $this->search = $search;
    }
    
    ...
    $this->search->setParams($request->all());
    $people = $this->personRepository->search($this->search,['name']);
```

### Reset filters

```php
$this->personRepository->skipCriteria(true);
```


## Todo
- [x] Load criteria automatically based on request
- [ ] Implement default pagination to result
- [ ] Implement default fields to return on query (Repository)
- [ ] Implement unit tests 
