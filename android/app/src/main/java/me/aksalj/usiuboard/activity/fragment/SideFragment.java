package me.aksalj.usiuboard.activity.fragment;

import android.content.Context;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;

import butterknife.ButterKnife;
import butterknife.InjectView;
import me.aksalj.usiuboard.R;
import me.aksalj.usiuboard.activity.MainActivity;
import me.aksalj.usiuboard.activity.adapter.NavigationAdapter;
import me.aksalj.view.AboutDialogView;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.activity.fragment.SideFragment
 * Date : Feb, 04 2015 5:06 PM
 * Description :
 */
public class SideFragment extends BaseFragment implements AdapterView.OnItemClickListener {

    @InjectView(R.id.navList)
    ListView mNavList;

    @InjectView(R.id.infoList)
    ListView mInfoList;

    public static SideFragment newInstance(Context cxt) {
        SideFragment instance = new SideFragment();
        instance.mCxt = cxt;
        return instance;
    }


    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_sidebar, null);

        ButterKnife.inject(this, root);

        return root;
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);

        mNavList.setAdapter(new NavigationAdapter(mActivity));
        mNavList.setOnItemClickListener(this);

        mInfoList.setOnItemClickListener(this);

    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        switch (parent.getId()) {
            case R.id.navList:
                // TODO: Switch main content
                BoardFragment listFragment = BoardFragment.getInstance();
                if(listFragment != null) {
                    listFragment.changeContent((int) id);
                }
                break;
            case R.id.infoList:
                // TODO: Open info activities/dialogs
                switch (position) {
                    case 0: // Help & Feedback
                        break;
                    case 1: // About
                        new AboutDialogView(mCxt).show();
                        break;
                }
                break;
        }

        ((MainActivity)mActivity).closeDrawer();
    }


    @Override
    public String getTitle() {
        return null;
    }

    @Override
    public String getSubTitle() {
        return null;
    }


}
