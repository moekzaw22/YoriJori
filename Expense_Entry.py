import tkinter as tk
from tkcalendar import DateEntry
from tkinter import messagebox
import pymysql
from datetime import datetime

class Expense_Entry(tk.Frame):
    def __init__(self, master=None):
        super().__init__(master)
        self.pack()

        tk.Label(self, text="Entry").pack()

        # Entry frame
        self.entry_frame = tk.Frame(self)
        self.entry_frame.pack(pady=10)

        tk.Label(self.entry_frame, text="Date:").grid(row=0, column=0, padx=5, pady=5)
        self.Entry_Date = tk.Entry(self.entry_frame)
        self.Entry_Date.grid(row=0, column=1, padx=5, pady=5)

        cal = DateEntry(self.entry_frame, width=12, background='darkblue', foreground='white', borderwidth=2)
        cal.grid(row=0, column=2, padx=10, pady=10)

        self.result_label = tk.Label(self.entry_frame, text="")
        self.result_label.grid(row=1, column=0, columnspan=3, pady=10)

        get_date_button = tk.Button(self.entry_frame, text="Get Selected Date", command=self.get_selected_date)
        get_date_button.grid(row=2, column=0, columnspan=3, pady=10)

        tk.Label(self.entry_frame, text="Category:").grid(row=3, column=0, padx=5, pady=5)
        self.Entry_Category = tk.Entry(self.entry_frame)
        self.Entry_Category.grid(row=3, column=1, padx=5, pady=5)

        tk.Label(self.entry_frame, text="Item:").grid(row=4, column=0, padx=5, pady=5)
        self.Entry_Item = tk.Entry(self.entry_frame)
        self.Entry_Item.grid(row=4, column=1, padx=5, pady=5)

        tk.Label(self.entry_frame, text="Quantity:").grid(row=5, column=0, padx=5, pady=5)
        self.Entry_Quantity = tk.Entry(self.entry_frame)
        self.Entry_Quantity.grid(row=5, column=1, padx=5, pady=5)

        tk.Label(self.entry_frame, text="Amount:").grid(row=6, column=0, padx=5, pady=5)
        self.Entry_Amount = tk.Entry(self.entry_frame)
        self.Entry_Amount.grid(row=6, column=1, padx=5, pady=5)

        add_button = tk.Button(self.entry_frame, text="Add Expense", command=self.add_expense)
        add_button.grid(row=7, column=0, columnspan=2, pady=10)

    def get_selected_date(self):
        selected_date = self.Entry_Date.get()
        self.result_label.config(text=f"Selected Date: {selected_date}")

    def show_success_alert(self):
        messagebox.showinfo("Success", "Expense added successfully!")

    def show_failure_alert(self, error_message):
        messagebox.showerror("Error", f"Failed to add expense. Error: {error_message}")

    def add_expense(self):
        connection = pymysql.connect(
            host='localhost',
            user='root',
            password='',
            database='Yori_jori',
            port=3306
        )

        try:
            # Create a cursor object to interact with the database
            with connection.cursor() as cursor:
                # Sample query to insert expense data
                input_date_str = self.Entry_Date.get()

                # Parse the input date string into a datetime object
                date = datetime.strptime(input_date_str, '%m/%d/%y')

                category = self.Entry_Category.get()
                item = self.Entry_Item.get()
                quantity = self.Entry_Quantity.get()
                amount = self.Entry_Amount.get()

                sql_query = f"INSERT INTO expense (Expense_ID,date, category, Description, quantity, amount) " \
                            f"VALUES ('','{date}', '{category}', '{item}', '{quantity}', '{amount}')"
                # Execute the SQL query
                cursor.execute(sql_query)

            # Commit the changes to the database
            connection.commit()
            self.show_success_alert()

        except Exception as e:
            # Show failure alert with the error message
            self.show_failure_alert(str(e))

        finally:
            # Close the connection, whether the query is successful or an exception is raised
            connection.close()

# Create the main window
root = tk.Tk()
root.title("Expense Entry")

# Instantiate the Expense_Entry
expense_entry = Expense_Entry(root)

# Start the Tkinter event loop
root.mainloop()
