# MovieSeries - Symfony

## Description

This project is a movie recommendation system; implementation part

With recommend filters and validators, simple HTML forms and implement external libs

### Expansion of https://github.com/JanoPL/recommendation-system/ 
- Create an entity class EntertainmentProduct, which will be extended by Movie and Series. 
- Series should have a property “seasonsNumber”, which will store information about the number of seasons, and Movie a property “genre”, which will store information about the genre. 
- Pay attention to the typing of arguments, returns and properties. Avoid mixins. 
- Rebuild the filter handling to use the Strategy design pattern https://refactoring.guru/pl/design-patterns/strategy 
- Add a filter for the genre and seasonsNumber properties 
### Symfony
- Write in Symfony >= 6.x an application interface that allows filtering data using the recommendation system from https://github.com/JanoPL/recommendation-system/ .
- Use Symfony Form and Symfony Validator. 
- Movie/series database built into the application 
- Simple HTML form 

### Forms: 
Input fields: name, filtering method, type, number of seasons  


Requirements for input fields:

- name string [validation: not required, minimum 3 characters]
- filtering method select [from src/Filters] [validation: required]
- type select (movie/series) [validation: not required]
- number of seasons number [dependent field, invisible at start, see requirements below][validation: required if type series was given] 

### Transformations of form fields:
- Name - using Form Transformer transform the search element removing characters that are not a letter, number, space, hyphen (e.g: “Taxi $3=” to “Taxi 3”)
- In case of choosing filtering method as “series” and clicking submit add to the form field “number of seasons”

### Output data

Output data (example):

Number of suggestions: 11
- Name: Lost, type: series,
- Name: Star Trek, type: movie, 
- Name: Star Trek, type: series,
- etc (…)

## Build and run
 
1. clone ```git clone git@github.com:JanoPL/moviese.git```
2. cd moviese
3. Configure .env from .env.example
4. generate app key ```php ./bin/console secrets:generate-keys```
5. Install dependencies ```composer install```
6. Install and build npm/yarn dependecies ```npm install && npm run build``` or ```yarn install && yarn build```
7. cd .docker
8. Run docker compose ```docker compose up -d```
9. execute migrations ``` docker compose exec php /bin/bash```  after entered container shell, execute ```./bin/console doctrine:migrations:migrate```
10. Open URL http://localhost:80 and see if everything it's working fine 