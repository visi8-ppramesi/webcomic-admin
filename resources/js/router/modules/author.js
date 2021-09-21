/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const authorRoutes = {
  path: '/author',
  component: Layout,
  redirect: '/author/list',
  children: [
    {
      path: 'list',
      component: () => import('@/views/authors/List'),
      name: 'Author',
      meta: { title: 'Author', icon: 'user', noCache: true },
    },
  ],
};

export default authorRoutes;
