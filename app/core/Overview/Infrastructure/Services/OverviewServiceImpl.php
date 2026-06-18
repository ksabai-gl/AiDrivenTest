<?php

namespace Core\Overview\Infrastructure\Services;

use Core\Overview\Domain\Entities\Overview;
use Core\Overview\Domain\Services\OverviewService;
use Core\Overview\Domain\Repositories\OverviewRepositoryInterface;

class OverviewServiceImpl implements OverviewService
{
    public function __construct(private OverviewRepositoryInterface $repo) {}

    public function index(array $data): array
    {
        $prepare = [
            'top' => [
                ...$this->repo->getCacheForMonth($data)
            ],
            'revenue' => [
                ...$this->repo->getCacheRevenueByTime($data)
            ],
            'expense' => [
                ...$this->repo->getCacheExpenseByTime($data),
            ],
            'chart' => $this->repo->getCacheForYear($data),
        ];
        $response = $prepare;
        foreach($prepare['top'] as $key => $value) {
            $value->compare_text = __($value->compare_text);
            $value->type = __($value->type);
            $response['top'][$key] = $value;
        }
        foreach($prepare['revenue'] as $key => $value) {
            $value->compare_text = __($value->compare_text);
            $value->type = __($value->type);
            $response['revenue'][$key] = $value;
        }
        foreach($prepare['expense'] as $key => $value) {
            $value->compare_text = __($value->compare_text);
            $value->type = __($value->type);
            $response['expense'][$key] = $value;
        }
        foreach($prepare['chart'] as $key => $value) {
            $value['name'] = __($value['name']);
            $response['chart'][$key] = $value;
        }
        return $response;
    }

    public function createCacheForYear(array $data): array
    {
        $chart = [];
        $months = [
            'january','february','march','april','may','june',
            'july','august','september','october','november','december',
        ];

        foreach ($months as $index => $month) {
            $chart[] = [
                ...$this->repo->businessChart([
                    'business_id' => $data['business_id'],
                    'month' => $index + 1,
                ]),
                'name' => 'overview::messages.month.' . $month,
            ];
        }

        return $this->repo->createCacheForYear($chart, $data['business_id']);
    }

    public function createCacheForMonth(array $data): array
    {
        $array = [];

        $array[] = new Overview(
            current: $this->repo->getOrder([
                'month' => date('m'),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getOrder([
                'month' => now()->subMonth()->month,
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.monthly_orders',
            compare_text: 'overview::messages.overview.compare.last_month',
            icon: 'bi bi-bag-plus'
        );

        $array[] = new Overview(
            current: $this->repo->getProduct([
                'month' => date('m'),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getProduct([
                'month' => now()->subMonth()->month,
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.monthly_products',
            compare_text: 'overview::messages.overview.compare.last_month',
            icon: 'bi bi-file-earmark-binary'
        );

        $array[] = new Overview(
            current: $this->repo->getCustomer([
                'month' => date('m'),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getCustomer([
                'month' => now()->subMonth()->month,
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.monthly_customers',
            compare_text: 'overview::messages.overview.compare.last_month',
            icon: 'bi bi-people'
        );

        $array[] = new Overview(
            current: $this->repo->getPurchase([
                'month' => date('m'),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getPurchase([
                'month' => now()->subMonth()->month,
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.monthly_purchase',
            compare_text: 'overview::messages.overview.compare.last_month'
        );

        return $this->repo->createCacheForMonth($array, $data['business_id']);
    }

    public function createRevenueByTime(array $data): void
    {
        $array = [];

        $array[] = new Overview(
            current: $this->repo->getRevenueByTime([
                'start' => now()->startOfDay(),
                'end'   => now()->endOfDay(),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getRevenueByTime([
                'start' => now()->subDay()->startOfDay(),
                'end'   => now()->subDay()->endOfDay(),
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.daily_revenues',
            compare_text: 'overview::messages.overview.compare.last_day'
        );

        $array[] = new Overview(
            current: $this->repo->getRevenueByTime([
                'start' => now()->startOfWeek(),
                'end'   => now()->endOfWeek(),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getRevenueByTime([
                'start' => now()->subWeek()->startOfWeek(),
                'end'   => now()->subWeek()->endOfWeek(),
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.weekly_revenues',
            compare_text: 'overview::messages.overview.compare.last_week'
        );

        $array[] = new Overview(
            current: $this->repo->getRevenueByTime([
                'start' => now()->startOfMonth(),
                'end'   => now()->endOfMonth(),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getRevenueByTime([
                'start' => now()->subMonth()->startOfMonth(),
                'end'   => now()->subMonth()->endOfMonth(),
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.monthly_revenues',
            compare_text: 'overview::messages.overview.compare.last_month'
        );

        $array[] = new Overview(
            current: $this->repo->getRevenueByTime([
                'start' => now()->startOfYear(),
                'end'   => now()->endOfYear(),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getRevenueByTime([
                'start' => now()->subYear()->startOfYear(),
                'end'   => now()->subYear()->endOfYear(),
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.yearly_revenues',
            compare_text: 'overview::messages.overview.compare.last_year'
        );

        $this->repo->createCacheRevenueByTime($array, $data['business_id']);
    }

    public function createExpenseByTime(array $data): void
    {
        $array = [];

        $array[] = new Overview(
            current: $this->repo->getExpenseByTime([
                'start' => now()->startOfDay(),
                'end'   => now()->endOfDay(),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getExpenseByTime([
                'start' => now()->subDay()->startOfDay(),
                'end'   => now()->subDay()->endOfDay(),
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.daily_expenses',
            compare_text: 'overview::messages.overview.compare.last_day'
        );

        $array[] = new Overview(
            current: $this->repo->getExpenseByTime([
                'start' => now()->startOfWeek(),
                'end'   => now()->endOfWeek(),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getExpenseByTime([
                'start' => now()->subWeek()->startOfWeek(),
                'end'   => now()->subWeek()->endOfWeek(),
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.weekly_expenses',
            compare_text: 'overview::messages.overview.compare.last_week'
        );

        $array[] = new Overview(
            current: $this->repo->getExpenseByTime([
                'start' => now()->startOfMonth(),
                'end'   => now()->endOfMonth(),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getExpenseByTime([
                'start' => now()->subMonth()->startOfMonth(),
                'end'   => now()->subMonth()->endOfMonth(),
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.monthly_expenses',
            compare_text: 'overview::messages.overview.compare.last_month'
        );

        $array[] = new Overview(
            current: $this->repo->getExpenseByTime([
                'start' => now()->startOfYear(),
                'end'   => now()->endOfYear(),
                'business_id' => $data['business_id'],
            ]),
            prev: $this->repo->getExpenseByTime([
                'start' => now()->subYear()->startOfYear(),
                'end'   => now()->subYear()->endOfYear(),
                'business_id' => $data['business_id'],
            ]),
            type: 'overview::messages.overview.type.yearly_expenses',
            compare_text: 'overview::messages.overview.compare.last_year'
        );

        $this->repo->createCacheExpenseByTime($array, $data['business_id']);
    }
}
