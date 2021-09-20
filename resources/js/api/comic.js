import request from '@/utils/request';

export function fetchComics(query) {
  return request({
    url: '/comics',
    method: 'get',
    params: query,
  });
}

export function fetchComic(id, query) {
  return request({
    url: '/comics/' + id,
    method: 'get',
    params: query,
  });
}

export function fetchPv(id) {
  return request({
    url: '/comics/' + id + '/pageviews',
    method: 'get',
  });
}

export function createComic(data) {
  return request({
    url: '/comic/create',
    method: 'post',
    data,
  });
}

export function updateComic(data) {
  return request({
    url: '/comic/update',
    method: 'patch',
    data,
  });
}
