SELECT *
FROM `api_orders`
WHERE
  date(`reserved_from`) = '2017-02-02'
  AND
(
  (
      `reserved_from` >= '2017-02-02 17:30:00'
    AND
      `reserved_to` <= '2017-02-02 20:30:00'
  )
  OR
  (
      `reserved_from` <= '2017-02-02 17:30:00'
    AND
      `reserved_to` >= '2017-02-02 20:30:00'
  )
  OR
  (
      `reserved_from` BETWEEN '2017-02-02 17:30:00' AND '2017-02-02 20:30:00'
      OR
      `reserved_to`  BETWEEN '2017-02-02 17:30:00' AND '2017-02-02 20:30:00'
  )
)


select * from `orders`
where date(`reserved_from`) = '2017-02-03'
and `position` = '0'
and (
  `reserved_from` >= '2017-02-03 18:30:00'
  and
  `reserved_to` <= '2017-02-03 22:00:00'
  )
  or
  (`reserved_from` <= '2017-02-03 18:30:00' and `reserved_to` >= '2017-02-03 22:00:00') or (`reserved_from` between '2017-02-03 18:30:00' and '2017-02-03 22:00:00' or (`reserved_to` between '2017-02-03 18:30:00' and '2017-02-03 22:00:00'))


select * from `api_orders`
where date(`reserved_from`) = '2017-05-15'
and (
  (`reserved_from` > '2017-05-15 7:00' and `reserved_to` < '2017-05-15 23:59')
  or
  (`reserved_from` < '2017-05-15 23:59' and `reserved_to` > '2017-05-15 23:59')
  or
  (`reserved_from` between '2017-05-15 7:01' and '2017-05-15 23:58'
    or (
    `reserved_to` between '2017-05-15 7:01' and '2017-05-15 23:58'
    )
  )
)

