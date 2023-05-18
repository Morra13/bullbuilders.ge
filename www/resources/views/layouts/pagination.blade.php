<?
$dir = strlen(url()->current());
$full = url()->full();
if (empty($_GET)) {
    $url = substr($full, $dir) . '?';
} else {
    $url = substr($full, $dir) . '&';
}
?>
@if($pagination['page_count'] > 1)
    <div class="card-footer py-4">
        <nav aria-label="...">
            <ul class="pagination justify-content-center mb-0">
                @if($pagination['page'] > 1)
                    <li class="page-item">
                        <a class="page-link" href="/{{Illuminate\Support\Facades\Route::getCurrentRoute()->uri() . $url . 'page=' . ($pagination['page'] - 1) }}" tabindex="-1">
                            <i class="fas fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @endif
                @for($i = 1; $i <= $pagination['page_count']; $i++)
                    <li class="page-item {{$pagination['page'] == $i ? 'active' : ''}}">
                        <a class="page-link" href="/{{Illuminate\Support\Facades\Route::getCurrentRoute()->uri() . $url . 'page=' . $i }}">{{$i}}</a>
                    </li>
                @endfor
                @if($pagination['page'] < $pagination['page_count'])
                    <li class="page-item">
                        <a class="page-link" href="/{{Illuminate\Support\Facades\Route::getCurrentRoute()->uri() . $url . 'page=' . ($pagination['page'] + 1) }}" tabindex="+1">
                            <i class="fas fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
