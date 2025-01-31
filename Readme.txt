    Cloning the Repository

To clone the project, use the following command:
    git clone <repository_url>


Setting Up the Database:
    1. Create a MySQL database named notes.
    2. Create the following tables with their respective columns:


    Table: notes
	sno (int, Primary Key, Auto_incriment)
	title (text, Not Null)
	description (text, Not Null)
	timestamp (datetime ,default: current_timestamp())