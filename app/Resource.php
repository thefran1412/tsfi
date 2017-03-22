<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Resource extends Model
{
    protected $table = 'recursos';
    protected $primaryKey = 'recurs_id';
    public $timestamps = false;
    protected $fillable = ['recurs_id',
                            'titolRecurs',
                            'subTitol',
                            'descBreu',
                            'descDetaill1',
                            'descDetaill2',
                            'relevancia',
                            'dataInici',
                            'dataFinal',
                            'gratuit',
                            'preuInferior',
                            'preuSuperior',
                            'dataPublicacio',
                            'visible',
                            'fotoResum',
                            'creatPer',
                            'idLocalitzacio'];

    protected $dates = ['created_at',
                            'updated_at',
                            'deleted_at',
                            'dataInici',
                            'dataFinal',
                            'dataPublicacio'];

    // Funciones (Relaciones)
    public function category(){ // OK
        return $this->belongsToMany('App\Category','categoria_recurs','idRecurs','idCategoria');
        // ->withTimestamps();
    }
    public function age(){ //OK
        return $this->belongsToMany('App\Age','edats_recurs','idRecurs','idEdat');
    }
    public function entity(){ //OK
        return $this->belongsToMany('App\Entity','entitat_recurs','idRecurs','idEntitat');
    }
    public function imageResource(){ //OK
        return $this->hasMany('App\ImageResource', 'idRecurs');
    }
    public function link(){ //OK
        return $this->hasMany('App\Link','idRecurs');
    }
    public function location(){ //OK
        return $this->belongsTo('App\Location','idLocalitzacio');
    }
    public function podcast(){ //OK
        return $this->hasMany('App\Podcast','idRecurs');
    }
    public function tag(){ //OK
        return $this->belongsToMany('App\Tag','tag_recurs','idRecurs','idTag');
    }
    public function targets(){ //OK
        return $this->belongsToMany('App\Target','target_recurs','idRecurs','idTarget');
    }
    public function videoResource(){ //OK
        return $this->hasMany('App\VideoResource','idRecurs');
    }
    public function videoType(){ //OK
        return $this->belongsToMany('App\VideoType','video_recurs','idRecurs','idTipus');
    }
}