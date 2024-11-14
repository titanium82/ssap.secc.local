<div class="d-none d-md-flex">
    <div class="nav-item dropdown d-none d-md-flex me-3">
        <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications"
            aria-expanded="false">
            <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
            </svg>
            @if($count_notify_unread)
                <span class="badge bg-red"></span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Notifications')</h3>
                </div>
                <div class="list-group list-group-flush list-group-hoverable">
                    @forelse ($notifications as $notification)
                        <div class="list-group-item p-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span @class([
                                        'status-dot d-block', 'status-dot-animated bg-red' => $notification->unread()
                                    ])>
                                    </span>
                                </div>
                                <div class="col">
                                    <a href="{{ route('admin.notification.show', $notification->id) }}" class="text-body d-block">{{ $notification->data['title'] }}</a>
                                    <div class="d-block text-secondary text-truncate mt-n1">
                                        {{ $notification->data['sub_title'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                {{ $notification->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item">
                            <img src="{{ asset('public/core/assets/images/norecord.svg') }}" alt="">
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
