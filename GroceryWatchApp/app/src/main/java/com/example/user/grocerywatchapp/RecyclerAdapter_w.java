package com.example.user.grocerywatchapp;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import java.util.ArrayList;

public class RecyclerAdapter_w extends RecyclerView.Adapter<RecyclerAdapter_w.RecyclerViewHolder>{
    private static final int TYPE_HEAD = 0;
    private static final int TYPE_LIST = 1;

    ArrayList<Food> arrayList = new ArrayList<>();

    public RecyclerAdapter_w(ArrayList<Food> arrayList){
        this.arrayList = arrayList;
    }

    @Override
    public RecyclerViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {

        if(viewType==TYPE_HEAD){
            View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.headerw_layout,parent,false);
            RecyclerViewHolder recyclerViewHolder = new RecyclerViewHolder(view,viewType);
            return recyclerViewHolder;
        }
        else if (viewType==TYPE_LIST){
            View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.roww_layout,parent,false);
            RecyclerViewHolder recyclerViewHolder = new RecyclerViewHolder(view,viewType);
            return recyclerViewHolder;
        }
        return null;
    }

    @Override
    public void onBindViewHolder(RecyclerViewHolder holder, int position) {

        if (holder.viewType==TYPE_LIST)
        {
            Food food = arrayList.get(position-1);
            holder.Id.setText(Integer.toString(food.getId()));
            holder.Time.setText(food.getTime());
            holder.Weight.setText(String.valueOf(food.getWeight()));
        }
    }

    @Override
    public int getItemCount() {
        return arrayList.size()+1;
    }

    public static class RecyclerViewHolder extends RecyclerView.ViewHolder{

        TextView Id, Time, Weight;
        int viewType;
        public RecyclerViewHolder(View view, int viewType){

            super(view);
            if (viewType==TYPE_LIST){
                Id = (TextView)view.findViewById(R.id.id_w);
                Time = (TextView)view.findViewById(R.id.time_w);
                Weight = (TextView)view.findViewById(R.id.weight_w);
                this.viewType = TYPE_LIST;
            }
            else if(viewType == TYPE_HEAD)
            {
                this.viewType = TYPE_HEAD;
            }



        }
    }

    @Override
    public int getItemViewType(int position) {
        if (position==0)
            return TYPE_HEAD;
            return TYPE_LIST;
    }
}
