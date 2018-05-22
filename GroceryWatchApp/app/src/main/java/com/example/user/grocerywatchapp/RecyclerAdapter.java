package com.example.user.grocerywatchapp;

import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.jar.Attributes;

public class RecyclerAdapter extends RecyclerView.Adapter<RecyclerAdapter.RecyclerViewHolder>{
    private static final int TYPE_HEAD = 0;
    private static final int TYPE_LIST = 1;

    ArrayList<drink> arrayList = new ArrayList<>();

    public RecyclerAdapter(ArrayList<drink> arrayList){
        this.arrayList = arrayList;

    }



    @Override
    public RecyclerViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {

        if (viewType==TYPE_HEAD){
            View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.header_layout,parent,false);
            RecyclerViewHolder recyclerViewHolder = new RecyclerViewHolder(view,viewType);
            return recyclerViewHolder;

        }
        else if(viewType==TYPE_LIST){
            View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.row_layout,parent,false);
            RecyclerViewHolder recyclerViewHolder = new RecyclerViewHolder(view,viewType);

            return recyclerViewHolder;

        }
        return null;

    }

    @Override
    public void onBindViewHolder(RecyclerViewHolder holder, int position) {
        if (holder.viewType==TYPE_LIST){

            drink drink = arrayList.get(position-1);
            holder.Id.setText(Integer.toString(drink.getId()));
            holder.Time.setText(drink.getTime());
            holder.Cans.setText(Integer.toString(drink.getCan()));

        }


    }

    @Override
    public int getItemCount() {
        return arrayList.size()+1;
    }

    public static class RecyclerViewHolder extends RecyclerView.ViewHolder{
        TextView Id, Time, Cans;
        int viewType;

        public RecyclerViewHolder(View view, int viewType){

            super(view);
            if(viewType==TYPE_LIST){
                Id = (TextView)view.findViewById(R.id.id);
                Time = (TextView)view.findViewById(R.id.time);
                Cans = (TextView)view.findViewById(R.id.cans);
                this.viewType = TYPE_LIST;

            }
            else if(viewType == TYPE_HEAD){
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
