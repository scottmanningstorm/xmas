<?php

class FacilitiesRepository
{
	protected $facility_articles_model; 

	public function __construct() 
	{
		$this->facility_articles_model = new FacilityArticlesModel(); 
	}

	public function updateRelations($facility_id, $articles_ids)
	{
		$articles = $this->getRelateArticles($facility_id); 
	 
			if (is_array($articles)) {
 
				foreach ($articles as $article) {

					$article->delete($article->id); 

				}
			}

		foreach($articles_ids as $article_id) {
			$this->facility_articles_model->insert(array('facility_id' => $facility_id, 'article_id' => $article_id));  
		} 

	}

	public function getRelateArticles($facilities_id)
	{
		return $this->facility_articles_model->where('facility_id', '=', $facilities_id)->all();
	}

	public function getRelateArticleIds($facilities_id)
	{
		$articles = $this->getRelateArticles($facilities_id); 

		foreach ($articles as $article) {
			$id[] = $article->article_id; 
		}

		return $id; 
	}

	/* 
		!====- New functions added for search Form on front end -====!
	*/

	// Returns an array of record ids, so we can build our final query and order. 
	public function searchByCountry($country=null)
	{	
		if ($count != null) {
			$country = $this->facility_articles_models_model->where('country', '=', $country);
		} else {
			$country = $this->facility_articles_model->all()->orderBy('country'); 
		}
		
		return $country; 	
	}

	public function searchByCenter($center)
	{
		$center = $this->facility_articles_model->where('title', '=', $center);
		
		return $center; 
	} 

	// Gets any search resuts coming through by GET[]
	public function serachResults($center, $country=null, $order=null)
	{
		$results[] = $this->searchByCountry($country); 

		$results[] = $this->searchByCenter($center);

		$results = $this->facility_articles_model->where('id', '=', $results)->orderBy('country'); 
	}
}

?>