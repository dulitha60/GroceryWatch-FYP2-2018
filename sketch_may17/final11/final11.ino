
#include <UnoWiFiDevEd.h>
#include <Wire.h>
#include "HX711.h"

HX711 scale(A1, A0);


#define CONNECTOR     "rest"
#define SERVER_ADDR   "smartstorage.000webhostapp.com"
String uri;
float w1;

const int trigPin = 7;
const int echoPin = 10;

long duration, distance;
int can = 0;


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
 scale.set_scale(2250.05);// this value is obtained by calibrating the scale with known weights; see the README for details
  scale.tare();  
  
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);

}

void weight() {
  Serial.print("one reading:\t");
  Serial.print(scale.get_units(), 1);
//  Serial.print("\t| average:\t");       
//  Serial.println(scale.get_units(100)*10);
  
  w1 = (scale.get_units(100)*10);

  if(w1<1)
  {
    w1 = 0;
    
    }
 Serial.println(w1); 

  scale.power_down();              // put the ADC in sleep mode
  delay(1000);
  scale.power_up();
 
  uri = "/add_dataW1.php?";
  uri += "p_id=";
  uri += "1";
  uri += "&&weight=";
  uri += w1;
 
CiaoData data = Ciao.write(CONNECTOR, SERVER_ADDR, uri);
delay(1000);
  if (!data.isEmpty()){
    Serial.println( "State: " + String (data.get(1)) );
    Serial.println( "Response: " + String (data.get(2)) );
  }
  else{
    Serial.println("Write Error");
  }
}


void cans() {

  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distance = duration * 0.034 / 2;

  Serial.println(distance);

  if(distance < 12 )
  {
    can = 5;
  }else if(distance < 17 )
    {
      can = 4; 
      }else if(distance < 23 )
      {
        can = 3;
        }else if(distance < 29 )
        {
          can = 2;
          }else if(distance < 35 )
          {
            can = 1;
            }else 
            {
              can = 0;
              }

  Serial.println(can);

  uri = "/add_dataC1.php?";
  uri += "p_id=";
  uri += "1";
  uri += "&&can=";
  uri += can;
   
  CiaoData data = Ciao.write(CONNECTOR, SERVER_ADDR, uri);
  delay(1000);
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
  delay(1000);
  weight();
  delay(1000); 
  cans(); 
  
}
