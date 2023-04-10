<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\PostShow;
use App\Models\UpDownVote;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class PostOverview extends Widget
{
    protected int | string | array $columnSpan = 3;
    
    public ?Model $record = null;

    protected function getViewData(): array
    {
        return [
            'viewCount' => PostShow::where('post_id', '=', $this->record->id)->count(),
            'upVote' => UpDownVote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', 1)->count(),
            'downVote' => UpDownVote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', 0)->count(),
        ];
    }

    protected static string $view = 'filament.resources.post-resource.widgets.post-overview';
}
