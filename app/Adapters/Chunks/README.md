
# Адаптеры для чанков(умных элементов)

### App\Adapters\Chunks
В конструктор должен быть передан id страницы, по которому получаются данные, 
со всеми параметрами о странице, если тип элемента на странице равен:
 
  + 0 - возвращается html-код c поля `body`;
  + 1 - определяется тип чанка, все настройки c поля `body` 
  передаются в конкретный адаптер, предварительно сформировав ассоциативный массив;
  + 2 - //TODO description
  + 3 - //TODO description
  
  ### App\Adapters\Chunk
  
  **Абстрактный класс с методами**:
 
 Адаптер для чанка(умного элемента), который формирует json, записывая данные в БД.
 ```php 
 abstract public function fillJson(array $options): void;
 ```
 
 Переводит значение в двоичную строку, разбивает строку по символу, переворачивает массив.
 ```php
abstract public function complementArray(string $properties): array;
 ```
      
Формирует ассоциативный массив.
```php
 abstract public function reformatProperties(array $properties): array;
```

 ### App\Adapters\Link
 
 Реализует абстрактные методы класса Chunk.
 //TODO формирует html.