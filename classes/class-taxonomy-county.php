<?php namespace CAHNRSWP\Plugin\Forester_Directory;

class Taxonomy_County extends Taxonomy {

	// @var string $slug taxonomy slug
	protected $slug = 'new_county';

	// @var array $post_types
	protected $post_types = array( 'new_consultant' );

	// @var array $services Services consultants provide
	protected $counties = array(
		'clallam'      => 'Clallam',
		'clark'        => 'Clark',
		'cowlitz'      => 'Cowlitz',
		'grays-harbor' => 'Grays Harbor',
		'island'       => 'Island',
		'jefferson'    => 'Jefferson',
		'king'         => 'King',
		'kitsap'       => 'Kitsap',
		'lewis'    	   => 'Lewis',
		'mason'        => 'Mason',
		'pacific'      => 'Pacific',
		'pierce'       => 'Pierce',
		'san-juan'     => 'San Juan',
		'skagit'       => 'Skagit',
		'skamania'     => 'Skamania',
		'snohomish'    => 'Snohomish',
		'thurston'     => 'Thurston',
		'wahkiakum'    => 'Wahkiakum',
		'whatcom'      => 'Whatcom',
		'adams'        => 'Adams',
		'asotin'       => 'Asotin',
		'benton'       => 'Benton',
		'chelan'       => 'Chelan',
		'columbia'     => 'Columbia',
		'douglas'      => 'Douglas',
		'ferry'        => 'Ferry',
		'franklin'     => 'Franklin',
		'garfield'     => 'Garfield',
		'grant'        => 'Grant',
		'kittitas'     => 'Kittitas',
		'klickitat'    => 'Klickitat',
		'lincoln'      => 'Lincoln',
		'okanogan'     => 'Okanogan',
		'pend-oreille' => 'Pend Oreille',
		'spokane'      => 'Spokane',
		'stevens'      => 'Stevens',
		'walla-walla'  => 'Walla Walla',
		'whitman'      => 'Whitman',
		'yakima'       => 'Yakima',
	);


	public function get_counties() {
		return $this->counties;
	}


}