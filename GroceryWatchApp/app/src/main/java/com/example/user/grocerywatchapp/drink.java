package com.example.user.grocerywatchapp;

public class drink {
    private int id;
    private String time;
    private int can;

    public drink(int id, String time, int can){
        this.setId(id);
        this.setTime(time);
        this.setCan(can);
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

    public int getCan() {
        return can;
    }

    public void setCan(int can) {
        this.can = can;
    }
}
