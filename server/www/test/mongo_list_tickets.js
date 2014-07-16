var conn = new Mongo();
db = conn.getDB("bdTest");
var cursor = db.tickets.find();
while ( cursor.hasNext() ) {
   printjson( cursor.next() );
}
