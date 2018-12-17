<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
@if(\Illuminate\Support\Facades\DB::table('users')->where('id','=',backpack_user()->id)->value('back_door')==true)
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
@endif
<li><a href="{{ backpack_url('post') }}"><i class="fa fa-files-o"></i> <span>Post</span></a></li>
<li><a href="{{ backpack_url('event') }}"><i class="fa fa-files-o"></i> <span>节目</span></a></li>
<li><a href="{{ backpack_url('comment') }}"><i class="fa fa-files-o"></i> <span>评论</span></a></li>
<li><a href="{{ backpack_url('user') }}"><i class="fa fa-files-o"></i> <span>组员</span></a></li>
<li><a href="{{ backpack_url('group') }}"><i class="fa fa-files-o"></i> <span>团体</span></a></li>