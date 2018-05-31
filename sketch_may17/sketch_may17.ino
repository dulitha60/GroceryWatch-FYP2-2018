#include <UnoWiFiDevEd.h>
#include <Wire.h>
#include "HX711.h"

HX711 scale(A1, A0);
HX711 scale2(A2, A3);

#define CONNECTOR     "rest"
#define SERVER_ADDR   "grocerywatch.000webhostapp.com"
String uri;
String uri1;


float w1,w2;
const int trigPin2 = 7;
const int echoPin2 = 10;
long duration2, distance2;


void setup() {
 Serial.begin(38400);
  Ciao.begin();
 
  Serial.print("read average: \t\t");
  Serial.println(scale.read_average(50));   // print the average of 20 readings from the ADC

  Serial.print("get value: \t\t");
  Serial.println(scale.get_value(5));   // print the average of 5 readings from the ADC minus the tare weight (not set yet)

  Serial.print("get units: \t\t");
  Serial.println(scale.get_units(5), 1);  // print the average of 5 readings from the ADC minus tare weight (not set) divided 
            // by the SCALE parameter (not set yet) 
 scale.set_scale(2280.f);                      // this value is obtained by calibrating the scale with known weights; see the README for details
  scale.tare();  


  Serial.print("read average: \t\t");
  Serial.println(scale2.read_average(50));   // print the average of 20 readings from the ADC

  Serial.print("get value: \t\t");
  Serial.println(scale2.get_value(5));   // print the average of 5 readings from the ADC minus the tare weight (not set yet)

  Serial.print("get units: \t\t");
  Serial.println(scale2.get_units(5), 1);  // print the average of 5 readings from the ADC minus tare weight (not set) divided 
            // by the SCALE parameter (not set yet) 
 scale2.set_scale(2280.f);                      // this value is obtained by calibrating the scale with known weights; see the README for details
 scale2.tare(); 

  pinMode(trigPin2, OUTPUT);
  pinMode(echoPin2, INPUT);

}

void weight() {
  Serial.print("one reading:\t");
  Serial.print(scale.get_units(), 1);
  Serial.print("\t| average:\t");
  Serial.println(scale.get_units(10));
  w1 = (scale.get_units(10)*10);

  Serial.print("one reading2:\t");
  Serial.print(scale2.get_units(), 1);
  Serial.print("\t| average:\t");
  Serial.println(scale2.get_units(10));
  w2 = (scale2.get_units(10)*10);
  
  uri = "/add_data2.php?";
  uri += "Can=";
  uri += w1;
  uri +="&&Can=";
  uri += w2;
 
CiaoData data = Ciao.write(CONNECTOR, SERVER_ADDR, uri);
delay(3000);
  if (!data.isEmpty()){
    Serial.println( "State: " + String (data.get(1)) );
    Serial.println( "Response: " + String (data.get(2)) );
  }
}
  else{
    Serial.println("Write Error");
  }

void can() {

  uri1 = "/add_data.php?";
  uri1 += "weight=";
  uri1 += "22";
   
  CiaoData data = Ciao.write(CONNECTOR, SERVER_ADDR, uri1);

    if (!data.isEmpty())
    {
      Serial.println( "State: " + String (data.get(1)) );
      Serial.println( "Response: " + String (data.get(2)) );
    }
    else
    {
      Serial.println("Write Error");
    }
}

void loop()
{
  delay(10000);
  weight();
  delay(10000); 
  can(); 
  
}
