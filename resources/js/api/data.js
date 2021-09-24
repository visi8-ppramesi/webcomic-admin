import request from '@/utils/request';

export function fetchDailyTransactions(startDate, endDate){
  return request({
    url: '/data/transactions/daily/' + startDate + '/' + endDate,
    method: 'get',
  });
}
