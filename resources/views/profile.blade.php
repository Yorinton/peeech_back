@extends('layouts.app')

@section('content')
<div class="container mb50">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        @if(Auth::id() === $user->id) 
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                <h4 class="label_prof"><span>プロフィール画像</span></h4>
                <div class="thumb_container">
                    <img class="thumb" src="{{ $user->img_path }}">
                    <form class="form-group thumb_form" method="post" action="{{ url('/users/'.$user->id) }}" enctype="multipart/form-data" files='true'>
                    {{ csrf_field() }}                
                    {{ method_field('PATCH') }}                     
                        <input type="file" name="img_path">
                        <input type="submit" value="変更">
                    </form>
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>ニックネーム</span></h4>
                <form method="POST" action="{{ url('/users/'.$user->id) }}">
                    {{ csrf_field() }}                
                    {{ method_field('PATCH') }}                
                    <div class="form-group disfle">
                        <input name="name" type="text" class="form-control inputBaseStyle mr10" value="{{ $user->name }}" placeholder="ニックネーム" id="" required>
                        <input class="form-control wd20" type="submit" value="変更">
                    </div>               
                </form>
            </div>
<!--             <div>
                <h4 class="label_prof">メールアドレス</h4>
                <form class="form-group" method="post" action="{{ url('/users/'.$user->id)}}">
                    {{ csrf_field() }}                
                    {{ method_field('PATCH') }}                                
                    <input name="email" type="email" class="form-control" placeholder="メールアドレス" id="" value="{{ decrypt($user->email) }}" required>
                    <input class="form-control" type="submit" value="変更">                   
                </form>                
            </div>  -->           
            <div>
                <h4 class="label_prof"><span>生年月日</span></h4>
                <form class="form-group" method="post" action="{{ url('/users/'.$user->id)}}">
                    {{ csrf_field() }}                
                    {{ method_field('PATCH') }}
                    <div class="sp-between">
                    <select name="year" class="form-control inputBaseStyle mr5">
                        @for($i=2002;$i>1949;$i--)
                            @if((int)$birthArr[0] === $i)
                            <option selected>{{ $i }}</option>
                            @else
                            <option>{{ $i }}</option>
                            @endif
                        @endfor
                    </select>
                    <select name="month" class="form-control inputBaseStyle mr5">
                        @for($i=1;$i<13;$i++)
                            @if((int)$birthArr[1] === $i)
                            <option selected>{{ $i }}</option>
                            @else
                            <option>{{ $i }}</option>
                            @endif
                        @endfor
                    </select>
                    <select name="day" class="form-control inputBaseStyle">
                        @for($i=1;$i<32;$i++)
                            @if((int)$birthArr[2] === $i)
                            <option selected>{{ $i }}</option>
                            @else
                            <option>{{ $i }}</option>
                            @endif
                        @endfor
                    </select>
                    </div>                                                     
                 <!--    <input name="birthday" type="" class="form-control" placeholder="2001年11月3日" value="{{ $user->birthday }}" id="" required> -->
                    <input class="form-control" type="submit" value="変更">                   
                </form>                
            </div>
            <div>
                <h4 class="label_prof"><span>性別</span></h4>
                <form class="form-group" method="post" action="{{ url('/users/'.$user->id)}}">
                    {{ csrf_field() }}                
                    {{ method_field('PATCH') }}
                    <div class="disfle">               
                        @if($user->sex == 'male')
                        <div class="wd40">
                            <input type="radio" name="sex" value="male" checked="checked">男性
                        </div>
                        <div class="wd40">
                            <input type="radio" name="sex" value="female">女性
                        </div>
                        @else
                        <div class="wd40">
                            <input type="radio" name="sex" value="male">男性
                        </div>
                        <div class="wd40">
                            <input type="radio" name="sex" value="female" checked="checked">女性
                        </div>
                        @endif
                        <input class="form-control wd20" type="submit" value="変更"> 
                    </div>                    
                </form>                                 
            </div>            
            <div>
                <h4 class="label_prof"><span>好きなアイドル</span></h4>
                <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                    {{ csrf_field() }}
                    <div class="disfle">
                        <select name='phonetic' class="form-control phonetic inputBaseStyle mr5 wd20">
                            <option value="1">あ行</option>
                            <option value="2">か行</option>
                            <option value="3">さ行</option>
                            <option value="4">た行</option>
                            <option value="5">な行</option>
                            <option value="6">は行</option>
                            <option value="7">ま行</option>
                            <option value="8">や行</option>
                            <option value="9">ら行</option>
                            <option value="10">わ行</option>
                        </select>
                        <select name="idol" class="form-control form-idol disblo inputBaseStyle mr5" id="idols_1">
                            @foreach($idol_masters->where('phonetic_id','>=',1)->where('phonetic_id','<=',5) as $idol)
                            <option>{{ $idol->idol }}</option>
                            @endforeach
                        </select>
                        <select name="" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_2">
                            @foreach($idol_masters->where('phonetic_id','>=',6)->where('phonetic_id','<=',10) as $idol)
                            <option>{{ $idol->idol }}</option>
                            @endforeach
                        </select>
                        <select name="" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_3">
                            @foreach($idol_masters->where('phonetic_id','>=',11)->where('phonetic_id','<=',15) as $idol)
                            <option>{{ $idol->idol }}</option>
                            @endforeach
                        </select>
                        <select name="" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_4">
                            @foreach($idol_masters->where('phonetic_id','>=',16)->where('phonetic_id','<=',20) as $idol)
                            <option>{{ $idol->idol }}</option>
                            @endforeach
                        </select>
                        <select name="" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_5">
                            @foreach($idol_masters->where('phonetic_id','>=',21)->where('phonetic_id','<=',25) as $idol)
                            <option>{{ $idol->idol }}</option>
                            @endforeach
                        </select>
                        <select name="" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_6">
                            @foreach($idol_masters->where('phonetic_id','>=',26)->where('phonetic_id','<=',30) as $idol)
                            <option>{{ $idol->idol }}</option>
                            @endforeach
                        </select>
                        <select name="" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_7">
                            @foreach($idol_masters->where('phonetic_id','>=',31)->where('phonetic_id','<=',35) as $idol)
                            <option>{{ $idol->idol }}</option>
                            @endforeach
                        </select>                                                                                      
                        <select name="" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_8">
                            @foreach($idol_masters->where('phonetic_id','>=',36)->where('phonetic_id','<=',40) as $idol)
                            <option>{{ $idol->idol }}</option>
                            @endforeach
                        </select> 
                        <select name="" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_9">
                            @foreach($idol_masters->where('phonetic_id','>=',41)->where('phonetic_id','<=',45) as $idol)
                            <option>{{ $idol->idol }}</option>
                            @endforeach
                        </select>
                        <select name="" class="form-control form-idol disnone inputBaseStyle mr5" id="idols_10">
                            @foreach($idol_masters->where('phonetic_id',46) as $idol)
                            <option>{{ $idol->idol }}</option>
                            @endforeach
                        </select>                   
                        <input class="form-control wd20" type="submit" value="追加"> 
                    </div>
                </form>
                <div>
                    @foreach($idols as $idol)
                    <span class='added_idol'>
                        <form class="form-group" method="post" action="{{ url('users/'.$user->id.'/'.$idol->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="idol" value="idol">
                            <input type="submit" value="×">
                            <span>{{ $idol->idol }}</span>
                        </form>
                    </span>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>推し</span></h4>
                <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                    {{ csrf_field() }}
                    <div class="disfle">
                        <input name="favorite" type="text" class="form-control form-favorite inputBaseStyle mr5" placeholder="推しの名前を記入" id="">
                        <input class="form-control wd20" type="submit" value="追加">
                    </div>
                </form>                
                <div>
                    @if($favorites)
                    @foreach($favorites as $favorite)
                    <span class='added_favorite'>
                        <form class="form-group" method="post" action="{{ url('users/'.$user->id.'/'.$favorite->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="favorite" value="favorite">
                            <input type="submit" value="×">
                            <span>{{ $favorite->favorite }}</span>
                        </form>
                    </span>
                    @endforeach
                    @endif
                </div>
            </div>
            <div>
                <h4 class="label_prof"><span>主な活動内容 (タップで追加)</span></h4>
                <div class="wrap">
                    @foreach($act_masters as $act_master)
                    <p>
                        <!-- true/falseで返すのはin_array(),キーを返すのはarray_search() -->
                        @if(in_array($act_master->activity,$activity_names))
                        <form class="form-group mr5" method="post" action="{{ url('users/'.$user->id)}}">
                            {{ csrf_field() }}
                            <input class="form-control selected_tag" type="submit" name="activity" value="{{ $act_master->activity }}">
                        </form>
                        @else
                        <form class="form-group mr5" method="post" action="{{ url('users/'.$user->id)}}">
                            {{ csrf_field() }}
                            <input class="form-control" type="submit" name="activity" value="{{ $act_master->activity }}">
                        </form>                        
                        @endif
                    </p>
                    @endforeach              
                </div>                
            </div>             
            <div>
                <h4 class="label_prof"><span>普段の活動場所</span></h4>
                <div>
                    <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="disfle">
                            <select name="region" type="text" class="form-control inputBaseStyle mr5" id="">
                                <option value="">選択して下さい</option>
                                @foreach($prefs as $pref)
                                    <option value="{{ $pref }}">{{ $pref }}</option>
                                @endforeach
                            </select>
                            <input class="form-control wd20" type="submit" value="変更">
                        </div>
                    </form>
                    <div>
                        @if($regions)
                        @foreach($regions as $region)
                        <span class='added_region'>
                            <form class="form-group" method="post" action="{{ url('users/'.$user->id.'/'.$region->id)}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="region" value="region">
                                <input type="submit" value="×">
                                <span>{{ $region->region }}</span>
                            </form>
                        </span>
                        @endforeach
                        @endif
                    </div>                    
                </div>
            </div>            
            <div>
                <h4 class="label_prof"><span>利用目的</span></h4>
                <div>
                    <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }} 
                        @foreach($purpose_masters as $purpose_master)
                        <p>
                            <!-- true/falseで返すのはin_array(),キーを返すのはarray_search() -->
                            @if(in_array($purpose_master->id,$purpose_ids))
                            <input type="checkbox" name="purpose[]" value="{{$purpose_master->id}}" checked="checked">{{ $purpose_master->purpose }}
                            @else
                            <input type="checkbox" name="purpose[]" value="{{$purpose_master->id}}">{{ $purpose_master->purpose }}
                            @endif
                        </p>
                        @endforeach
                        <input class="form-control" type="submit" value="変更"> 
                    </form>
                </div>
            </div>
 <!--            <div>
                <h4 class="label_prof">繋がりたい人</h4>
                <div>
                    <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}                    
                        @foreach($statue_masters as $statue_master)
                        <p>
                            @if(in_array($statue_master->id,$statue_ids))
                            <input type="checkbox" name="statue[]" value="{{$statue_master->id}}" checked="checked">{{ $statue_master->statue }}
                            @else
                            <input type="checkbox" name="statue[]" value="{{$statue_master->id}}">{{ $statue_master->statue }}
                            @endif
                        </p>
                        @endforeach
                        <input class="form-control" type="submit" value="変更"> 
                    </form>
                </div>
            </div> -->
 <!--            <div>
                <h4 class="label_prof">参加予定イベント</h4>
                <form class="form-group" method="post" action="{{ url('users/'.$user->id)}}">
                    {{ csrf_field() }} 
                    <input name="event" type="text" class="form-control form-idol" placeholder="" id="" required>
                    <input class="form-control" type="submit" value="追加"> 
                </form>
                <div>
                    @foreach($events as $event)
                    <span class='added_event'>
                        <form class="form-group" method="post" action="{{ url('users/'.$user->id.'/'.$event->id)}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="event" value="event">
                            <input type="submit" value="×">
                            <span>{{ $event->event }}</span>
                        </form>
                    </span>
                    @endforeach
                </div>
            </div> -->
            <div>
                <h4 class="label_prof"><span>自己紹介</span></h4>
                <form method="post" action="{{url('/users/'.$user->id)}}">
                {{ csrf_field() }}                
                {{ method_field('PATCH') }} 
                <div class="form-group">
                    <textarea name="introduction" class="form-control inputBaseStyle" placeholder="自己紹介" id="" rows="5" required>{{ $user->introduction }}</textarea>
                    <input class="form-control" type="submit" value="変更">
                </div>
                </form>
            </div>
        @else
            <form method="post" action="{{ url('/room') }}">
                {{ csrf_field() }}
                <input type="hidden" name="from_user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                <input type="submit" name="" value="メッセージを送る">
            </form>
            <div>
                <h4 class="label_prof">プロフィール画像</h4>
                <div>
                    <form class="form-group" method="post" action="{{ url('/users/profileimg')}}">
                        <img src="">
                        <input type="file">
                        <input type="submit" value="変更">
                    </form>
                </div>
            </div>
            <div>
                <h4 class="label_prof">ニックネーム</h4>                
                <div class="form-group">
                    <p>{{ $user->name }}</p>
                </div>               
            </div>
            <div>
                <h4 class="label_prof">メールアドレス</h4>
                <div class="form-group">                            
                    <p>{{ decrypt($user->email) }}</p>
                </div>          
            </div>            
            <div>
                <h4 class="label_prof">お誕生日</h4>
                <div class="form-group">                                
                    <p>{{ $user->birthday }}</p>
                </div>
            </div>
            <div>
                <h4 class="label_prof">性別</h4> 
                <div class="form-group">                                                             
                    @if($user->sex == 'male')
                    <p>男</p>
                    @else
                    <p>女</p>
                    @endif
                </div>
            </div>            
            <div>
                <h4 class="label_prof">好きなアイドル</h4>
                <div class="form-group">
                    @foreach($idols as $idol)
                    <span>{{ $idol->idol }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof">推し</h4>              
                <div class="form-group">
                    @foreach($favorites as $favorite)
                    <span>{{ $favorite->favorite }}</span>
                    @endforeach
                </div>
            </div> 
            <div>
                <h4 class="label_prof">活動場所</h4>
                <div>
                    @foreach($regions as $region)
                    <p>{{ $region->region }}</p>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof">利用目的</h4>
                <div>
                    @foreach($purpose_masters as $purpose_master)
                    <p>
                        <!-- true/falseで返すのはin_array(),キーを返すのはarray_search() -->
                        @if(in_array($purpose_master->id,$purpose_ids))
                        <p>{{ $purpose_master->purpose }}</p>
                        @endif
                    </p>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof">繋がりたい人</h4>
                <div>                    
                    @foreach($statue_masters as $statue_master)
                    <p>
                        <!-- true/falseで返すのはin_array(),キーを返すのはarray_search() -->
                        @if(in_array($statue_master->id,$statue_ids))
                        <p>{{ $statue_master->statue }}</p>
                        @endif
                    </p>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof">参加予定イベント</h4>
                <div>
                    @foreach($events as $event)
                    <span>{{ $event->event }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="label_prof">自己紹介</h4>
                <div class="form-group">
                    <p>{{ $user->introduction }}</p>
                </div>
            </div>            
        @endif
        </div>
    </div>
</div>
@endsection
