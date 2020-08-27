Back-end IIATIMD

Studentennummers:
- s1105799
- s1098119


Routes::

## Authenticate route
Deze route moet altijd eerst worden aangeroepem. Bij een succesvolle combinatie van email, password wordt er een token geretourneert.
Deze token moet in iedere route worden gebruikt ter authenticatie. voorbeeld: testroute/get?token=

POST: /api/authenticate
- Velden die meegestuurd moeten worden: email, password

## medicine routes
GET: Route::get('/medicine/index', 'medicineController@index')->middleware('checkToken');
- Retourneert alle medicijnen uit de database

GET: Route::get('/medicine/get/{id}', 'medicineController@get')->middleware('checkToken');
- GET route die een medicijn retourneert uit de database op basis van het meegegeven ID

POST: Route::post('/medicine/add', 'medicineController@add')->middleware('checkToken');
- Post route die een medicijn toevoegt aan de database
- Velden die meegegeven moeten worden: naam, dosering, wanneer, datum_van, datum_tot, tijd


// reminder routes
POST: Route::post('/reminder/add', 'reminderController@add')->middleware('checkToken');
- Post route die een reminder toevoegt aan de database
- Velden die meegegeven moeten worden: id, naam, dosering, wanneer, datum_van, datum_tot, tijd
- Het veld 'wanneer' moet de waarde hebben 7d of 1w. Als de reminder dagelijks moet moet het de waarde 7d hebben, als de reminder wekelijks moet, moet het de waarde hebben 1w.


GET: Route::get('/reminder/index', 'reminderController@index')->middleware('checkToken');
- GET route die alle reminders uit de database retourneert
