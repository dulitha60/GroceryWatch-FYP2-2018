package com.example.user.grocerywatchapp;

public class Food {

    private int id;
    private String time;
    private Double weight;

    public Food(int id, String time, Double weight)
    {
        this.setId(id);
        this.setTime(time);
        this.setWeight(weight);
 }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public Double getWeight() {
        return weight;
    }

    public void setWeight(Double weight) {
        this.weight = weight;
    }
}
