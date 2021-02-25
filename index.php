<?php

interface Generation
{
    public function Age();
}

class Family implements Generation
{
    public $lastName;
    public $city;
    public $adress;

    public function __construct(string $lastName, string $city, string $adress)
    {
        $this->lastName = $lastName;
        $this->city = $city;
        $this->adress = $adress;
    }

    private $peopleCount = 0;

    public function newMember()
    {
        $this->peopleCount++;
    }

    public function getPeopleCount()
    {
        return $this->peopleCount;
    }

    public function Age()
    {
        $this->age++;
    }
}


class Father extends Family
{
    public $name;
    public $age;
    public $wife;
    public $car;
    public $profession;
    public $temperament;
    public $intelligence;

    public function __construct(string $name, int $age, string $wife, Family $family, string $car, string $profession, string $temperament, string $intelligence)
    {
        $this->name = $name;
        $this->lastName = $family->lastName;
        $this->age = $age;
        $this->wife = $wife;
        $this->car = $car;
        $this->profession = $profession;
        $this->temperament = $temperament;
        $this->intelligence = $intelligence;
        $family->newMember();
    }
}

class Mother extends Family
{
    public $name;
    public $age;
    public $husband;
    public $car;
    public $profession;
    public $temperament;
    public $intelligence;

    public function __construct(Father $father, string $name, int $age, string $husband, Family $family, string $car, string $profession, string $temperament, string $intelligence)
    {
        $this->name = $name;
        $this->age = $age;
        $this->husband = $husband;
        $this->car = $father->car;
        $this->profession = $profession;
        $this->temperament = $temperament;
        $this->intelligence = $intelligence;
        $family->newMember();
    }
}

class Child extends Family
{
    public $name;
    public $lastName;
    public $age;
    public $sex;
    public $father;
    public $mother;
    public $temperament;
    public $intelligence;

    public function __construct(string $name, int $age, string $sex, Father $father, Mother $mother, Family $family)
    {
        $this->name = $name;
        $this->age = $age;
        $this->sex = $sex;
        $this->father = $father->name . " " . $father->lastName;
        $this->mother = $mother->name . " " . $mother->lastName;
        $this->temperament = $mother->temperament;
        $this->intelligence = $father->intelligence;
        $family->newMember();
   
    }
}

// ТЕСТИРОВАНИЕ

$family = new Family('Крупенко', 'Обнинск', 'Marksa 78');
$father = new Father('Алексей', 42, 'Ольга', $family, 'Toyota', 'предприниматель', 'взрывной', 'есть');
$mother = new Mother($father,'Ольга', 42, 'Алексей', $family, 'машина', 'экономист', 'спокойный', 'я ж тебе говорила...');
$daughter = new Child('Арина', 12, 'женский', $father, $mother, $family);
$son = new Child('Пётр', 9, 'мужской', $father, $mother, $family);
$son2 = new Child('Кир', 2, 'мужской', $father, $mother, $family);

echo 'Количество человек в семье: ' . $family->getPeopleCount();
echo '<br>Город: ' . $family->city;
echo '<br>Адрес: ' . $family->adress;

echo '<br><br>Отец:';
echo '<br>Имя: ' . $father->lastName . ' ' . $father->name;
echo '<br>Возраст: ' . $father->age;
echo '<br>Жена: ' . $father->wife;
echo '<br>Машина: ' . $father->car;
echo '<br>Профессия: ' . $father->profession;
echo '<br>Темперамент: ' . $father->temperament;
echo '<br>Интеллект: ' . $father->intelligence;



echo '<br><br>Мать:';
echo '<br>Имя: ' . $mother->lastName . ' ' . $mother->name;
echo '<br>Возраст: ' . $mother->age;
echo '<br>Муж: ' . $mother->husband;
echo '<br>Машина: ' . $mother->car;
echo '<br>Профессия: ' . $mother->profession;
echo '<br>Темперамент: ' . $mother->temperament;
echo '<br>Интеллект: ' . $mother->intelligence;



echo '<br><br>Дочь:';
echo '<br>Имя: ' . $daughter->lastName . ' ' . $daughter->name;
echo '<br>Возраст: ' . $daughter->age;
echo '<br>Пол: ' . $daughter->sex;
echo '<br>Темперамент: ' . $father->temperament;
echo '<br>Интеллект: ' . $mother->intelligence;

$son->Age();
echo '<br><br>Сын:';
echo '<br>Имя: ' . $son->lastName . ' ' . $son->name;
echo '<br>Был День рождения: ' . $son->age;
echo '<br>Пол: ' . $son->sex;
echo '<br>Темперамент: ' . $father->temperament;
echo '<br>Интеллект: ' . $father->intelligence;

echo '<br><br>и еще Сын:';
echo '<br>Имя: ' . $son2->lastName . ' ' . $son2->name;
echo '<br>Возраст: ' . $son2->age;
echo '<br>Пол: ' . $son2->sex;
echo '<br>Темперамент: ' . $mother->temperament;
echo '<br>Интеллект: ' . $father->intelligence;

?>