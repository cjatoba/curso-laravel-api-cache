<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses()
    {
        // Realiza a consulta no banco na primeira execução e guarda em cache por 60 segundos,
        // nas demais requisições consulta o banco somente se a informação não existir no cache
        // return Cache::remember('courses', 60, function () {
        //     $this->entity
        //                 ->with('modules.lessons')
        //                 ->get();
        // });

        // Realiza a consulta no banco na primeira execução e guarda em cache,
        // nas demais requisições consulta apenas o cache
        return Cache::rememberForever('courses', function () {
            return $this->entity
                        ->with('modules.lessons')
                        ->get();
        });

    }

    public function createNewCourse(array $data)
    {
        return $this->entity->create($data);
    }

    public function getCourseByUuid(string $identify, bool $loadRelationships = true)
    {
        return $this->entity
                    ->where('uuid', $identify)
                    ->with([$loadRelationships ? 'modules.lessons' : ''])
                    ->firstOrFail();
    }

    public function deleteCourseByUuid(string $identify)
    {
        $course = $this->getCourseByUuid($identify, false);

        return $course->delete();
    }

    public function updateCourseByUuid(string $identify, array $data)
    {
        $course = $this->getCourseByUuid($identify, false);

        return $course->update($data);
    }
}
