<?php

class School
{
    private $grades = [];

    public function add(string $name, int $grade): void
    {
        $this->getGrade($grade)->add($name);
    }

    public function grade(int $grade): array
    {
        return $this->getGrade($grade)->getStudents();
    }

    public function studentsByGradeAlphabetical(): array
    {
        return array_map(
            function (Grade $grade): array {
                return $grade->getStudents();
            },
            $this->grades
        );
    }

    private function getGrade(int $grade): Grade
    {
        if (!isset($this->grades[$grade])) {
            $this->grades[$grade] = new Grade();
            // We have to sort by key after an insert because even with numeric
            // indices, PHP sorts an array by insertion time.
            ksort($this->grades);
        }

        return $this->grades[$grade];
    }
}

class Grade
{
    private $students = [];

    public function add(string $name): void
    {
        $this->students[] = $name;
        sort($this->students);
    }

    public function getStudents(): array
    {
        return $this->students;
    }
}
