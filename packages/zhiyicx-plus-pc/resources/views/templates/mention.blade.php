@php
    use function Zhiyi\Component\ZhiyiPlus\PlusComponentPc\getAvatar;
    use function Zhiyi\Component\ZhiyiPlus\PlusComponentPc\getTime;
    use function Zhiyi\Component\ZhiyiPlus\PlusComponentPc\formatContent;
@endphp

@foreach ($mention as $item)

<li data-id="{{ $item['id'] }}" class="chat_mention_card">
    <img src="{{ getAvatar($item['user'], 40) }}"/>
    <div class="mention_info">
        <span class="name">{{ $item['user']['name'] }}</span>
        <span class="time">{{ getTime($item['created_at']) }}</span>
        @switch($item['resourceable']['type'])
            @case('feeds')
                @if($item['feeds']['feed_content'] ?? false)
                <div class="content">{!! formatContent($item['feeds']['feed_content']) !!}</div>
                @else
                <div class="content">内容不存在或已被删除</div>
                <script>console.log(@json($item));</script>
                @endif
                @break
            @case('comments')
                <span>{{ $item['comments']['body'] }}</span>

                @switch($item['repostable_type'])
                    @case('news')
                        <a class="content" href="{{ route('pc:newsread', ['news_id' => $item['repostable']['id']]) }}">
                            @if ($item['repostable']['image']['id'] ?? false)
                                <img src="{{ url('/api/v2/files/' . $item['repostable']['image']['id']) }}" class="cover">
                                <span>{{ $item['repostable']['title'] }}</span>
                            @endif
                        </a>
                        @break
                    @case('feeds')
                        @if($item['repostable']['message'] ?? false)
                        <span class="content">内容不存在或已被删除</span>
                        <script>console.log(@json($item));</script>
                        @else
                        <a class="content" href="{{ route('pc:feedread', ['feed_id' => $item['repostable']['id']]) }}">
                            {{ $item['repostable']['feed_content'] }}
                        </a>
                        @endif
                        @break
                    @default

                @endswitch
                @break
        @endswitch
    </div>
</li>
@endforeach
