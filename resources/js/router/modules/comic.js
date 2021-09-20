/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const comicsRoutes = {
  path: '/comics',
  component: Layout,
  redirect: 'noredirect',
  name: 'Comics',
  meta: {
    title: 'comics',
    icon: 'comic',
    permissions: ['view menu comics'],
  },
  children: [
    {
      path: 'list',
      component: () => import('@/views/comics/List'),
      name: 'ComicsList',
      meta: { title: 'Comics', noCache: true },
    },
    {
      path: 'create',
      component: () => import('@/views/comics/Create'),
      name: 'CreateComic',
      meta: { title: 'createComic', icon: 'edit', permissions: ['manage article'] },
      hidden: true,
    },
    {
      path: 'edit/:id(\\d+)',
      component: () => import('@/views/comics/Edit'),
      name: 'EditComic',
      meta: { title: 'editComic', noCache: true, permissions: ['manage article'] },
      hidden: true,
    },
  ],
};

export default comicsRoutes;
