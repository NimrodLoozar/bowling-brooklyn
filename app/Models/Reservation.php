<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lane_id',
        'date',
        'start_time',
        'end_time',
        'number_of_people',
        'status',
        'cost',
        'paid',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
        'paid' => 'boolean',
        'cost' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lane()
    {
        return $this->belongsTo(Lane::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'lane_id',
        'start_time',
        'end_time',
        'status',
        'comment',
        'validated',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lane()
    {
        return $this->belongsTo(Lane::class, 'lane_id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'reservations_id');
    }
}
