package me.aksalj.usiuboard.activity;

import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.content.res.Configuration;
import android.support.v4.app.FragmentManager;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBar;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.animation.AlphaAnimation;
import android.view.animation.Animation;

import butterknife.ButterKnife;
import butterknife.InjectView;
import me.aksalj.usiuboard.R;
import me.aksalj.usiuboard.activity.fragment.BaseFragment;
import me.aksalj.usiuboard.activity.fragment.BoardFragment;
import me.aksalj.usiuboard.activity.fragment.SideFragment;
import me.aksalj.utils.DeviceHelper;


public class MainActivity extends ActionBarActivity {

    @InjectView(R.id.toolbar)
    Toolbar mToolbar;

    @InjectView(R.id.drawer_layout)
    DrawerLayout mDrawerLayout;
    ActionBarDrawerToggle mDrawerToggle;

    BaseFragment mCurrentFragment;


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        if(DeviceHelper.isTablet(this)) {
            setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_LANDSCAPE);
        }

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        ButterKnife.inject(this);

        setupActionBar();
        setupDrawer();

        setupContent(BoardFragment.newInstance(this));
    }


    private void setupActionBar(){
        setSupportActionBar(mToolbar);
        ActionBar bar = getSupportActionBar();
        bar.setDisplayHomeAsUpEnabled(true);
    }

    private void setupDrawer(){
        mDrawerToggle = new ActionBarDrawerToggle(this, mDrawerLayout,  0,  0) {

            /** Called when a drawer has settled in a completely closed state. */
            public void onDrawerClosed(View view) {
                super.onDrawerClosed(view);
                toggleToolbar(true);
            }

            /** Called when a drawer has settled in a completely open state. */
            public void onDrawerOpened(View drawerView) {
                super.onDrawerOpened(drawerView);
                toggleToolbar(false);
            }
        };

        // Set the drawer toggle as the DrawerListener
        mDrawerLayout.setDrawerListener(mDrawerToggle);
        mDrawerToggle.setDrawerIndicatorEnabled(true);
        mDrawerLayout.setDrawerLockMode(DrawerLayout.LOCK_MODE_UNLOCKED);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    protected void onPostCreate(Bundle savedInstanceState) {
        super.onPostCreate(savedInstanceState);
        // Sync the toggle state after onRestoreInstanceState has occurred.
        mDrawerToggle.syncState();
    }

    @Override
    public void onConfigurationChanged(Configuration newConfig) {
        super.onConfigurationChanged(newConfig);
        mDrawerToggle.onConfigurationChanged(newConfig);
    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();

        boolean res = mCurrentFragment.onOptionsItemSelected(item);

        if(!res && id == R.id.action_settings) {
            startActivity(new Intent(this, SettingsActivity.class));
        }

        return mDrawerToggle.onOptionsItemSelected(item) || res || super.onOptionsItemSelected(item);
    }

    private void setupContent(BaseFragment fragment) {

        FragmentManager fragmentManager = getSupportFragmentManager();
        fragmentManager.beginTransaction()
                .replace(R.id.content_frame, fragment)
                .commit();

        mCurrentFragment = fragment;

        String title = mCurrentFragment.getTitle();
        String subtitle = mCurrentFragment.getSubTitle();
        if(title == null || title.isEmpty()) title = getString(R.string.app_name);
        if(subtitle == null || subtitle.isEmpty()) subtitle = getString(R.string.empty);
        mToolbar.setTitle(title);
        mToolbar.setSubtitle(subtitle);

    }

    public void setupSideBar() {
        FragmentManager fragmentManager = getSupportFragmentManager();
        fragmentManager.beginTransaction()
                .replace(R.id.content_sidebar, SideFragment.newInstance(this))
                .commit();
    }

    private void toggleToolbar(final boolean show) {
        float from = show ? 0.0f : 1.0f;
        float to = show ? 1.0f: 0.0f;
        Animation anim = new AlphaAnimation(from, to);
        anim.setDuration(300);
        anim.setAnimationListener(new Animation.AnimationListener() {
            @Override
            public void onAnimationStart(Animation animation) { }

            @Override
            public void onAnimationEnd(Animation animation) {
                if(show) {
                    mToolbar.setVisibility(View.VISIBLE);
                } else {
                    mToolbar.setVisibility(View.GONE);
                }
            }

            @Override
            public void onAnimationRepeat(Animation animation) {}
        });

        mToolbar.startAnimation(anim);
    }

    public void closeDrawer() {
        mDrawerLayout.closeDrawers();
    }

}
