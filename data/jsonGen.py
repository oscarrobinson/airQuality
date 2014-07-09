import csv     # imports the csv module
import sys      # imports the sys module

f = open(sys.argv[1], 'rU') # opens the csv file
jsonString = ""

s1Days = []
s2Days = []
s3Days = []
s4Days = []


def dayDataAsString(data):
	string = "";
	for datum in data:
		string+=datum
	return string.rstrip(',')


try:
	jsonString+="\""+sys.argv[2]+"\""+":{ "+"\"Spring\""+":["
	reader = csv.reader(f)  # creates the reader object
	for row in reader:   # iterates the rows of the file in orders
		if row[6]=="S1":
			s1Days+=[row]
		elif row[6]=="S2":
			s2Days+=[row]
		elif row[6]=="S3":
			s3Days+=[row]
		elif row[6]=="S4":
			s4Days+=[row]
	
	dayData = []
	prevDay = []			
	for day in s1Days:
		if prevDay == []:
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;
		elif day[1]==prevDay[1]:
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;
		else:
			jsonString+="{ \"Day\":"+"\""+prevDay[0]+"\""+", \"Date\":"+"\""+prevDay[1]+"\", \"Data\":["+dayDataAsString(dayData)+"]},"
			dayData = []
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;



	jsonString = jsonString.rstrip(',')
	jsonString+="], \"Summer\":["
	prevDay = []


	for day in s2Days:
		if prevDay == []:
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;
		elif day[1]==prevDay[1]:
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;
		else:
			jsonString+="{ \"Day\":"+"\""+prevDay[0]+"\""+", \"Date\":"+"\""+prevDay[1]+"\", \"Data\":["+dayDataAsString(dayData)+"]},"
			dayData = []
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;

	jsonString = jsonString.rstrip(',')
	jsonString+="], \"Autumn\":["
	prevDay = []


	for day in s3Days:
		if prevDay == []:
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;
		elif day[1]==prevDay[1]:
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;
		else:
			jsonString+="{ \"Day\":"+"\""+prevDay[0]+"\""+", \"Date\":"+"\""+prevDay[1]+"\", \"Data\":["+dayDataAsString(dayData)+"]},"
			dayData = []
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;

	jsonString = jsonString.rstrip(',')
	jsonString+="], \"Winter\":["
	prevDay = []

	for day in s4Days:
		if prevDay == []:
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;
		elif day[1]==prevDay[1]:
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;
		else:
			jsonString+="{ \"Day\":"+"\""+prevDay[0]+"\""+", \"Date\":"+"\""+prevDay[1]+"\", \"Data\":["+dayDataAsString(dayData)+"]},"
			dayData = []
			dayData+=["{\"hour\":"+day[3]+","+"\"reading\":"+"\""+day[5]+"\""+"},"]
			prevDay = day;


	jsonString = jsonString.rstrip(',')
	jsonString+="]}"

		
finally:
	text_file = open(sys.argv[2]+".json", 'a')
	text_file.write(jsonString)
	text_file.close()
	f.close()      # closing