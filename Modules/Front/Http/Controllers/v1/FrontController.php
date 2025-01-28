<?php

namespace Modules\Front\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Article\Cache\ArticleCache;
use Modules\Category\Cache\CategoryCache;
use Modules\Customer\Cache\CustomerCache;
use Modules\Experience\Cache\ExperienceCache;
use Modules\FAQ\Cache\FAQCache;
use Modules\Project\Cache\ProjectCache;
use Modules\Service\Cache\ServiceCache;

class FrontController extends Controller
{
    /**
     * Homepage
     */
    public function index()
    {
        $categories = CategoryCache::getAllCategories();
        $articles = ArticleCache::getTopArticles();
        $services = ServiceCache::getAllServices();
        $experiences = ExperienceCache::getAllExperiences();
        $customers = CustomerCache::getAllCustomers();
        $projects = ProjectCache::getTopProjects();
        $faqs = FaqCache::getAllFaqs();

        $data = compact('categories', 'articles', 'services', 'experiences', 'customers', 'projects', 'faqs');
        return successResponse($data);
    }

}
