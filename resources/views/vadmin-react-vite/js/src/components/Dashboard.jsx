import React from 'react'
import { 
  Users, 
  ShoppingBag, 
  TrendingUp, 
  DollarSign,
  Activity,
  Database,
  Server,
  Globe
} from 'lucide-react'
import { useConfig } from '@hooks/useConfig'

const StatCard = ({ title, value, change, icon: Icon, color = 'blue' }) => {
  const colorClasses = {
    blue: 'bg-blue-500 text-blue-600 bg-blue-50 dark:bg-blue-900/20',
    green: 'bg-green-500 text-green-600 bg-green-50 dark:bg-green-900/20',
    yellow: 'bg-yellow-500 text-yellow-600 bg-yellow-50 dark:bg-yellow-900/20',
    purple: 'bg-purple-500 text-purple-600 bg-purple-50 dark:bg-purple-900/20'
  }

  const [bgColor, textColor, cardBg] = colorClasses[color].split(' ')

  return (
    <div className="card p-6">
      <div className="flex items-center justify-between">
        <div>
          <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
            {title}
          </p>
          <p className="text-2xl font-bold text-gray-900 dark:text-white">
            {value}
          </p>
          {change && (
            <p className={`text-sm ${change.includes('+') ? 'text-green-600' : 'text-red-600'}`}>
              {change}
            </p>
          )}
        </div>
        <div className={`p-3 ${cardBg} rounded-lg`}>
          <Icon className={`w-6 h-6 ${textColor}`} />
        </div>
      </div>
    </div>
  )
}

const Dashboard = () => {
  const config = useConfig()

  const stats = [
    {
      title: 'Total Users',
      value: '2,847',
      change: '+12% from last month',
      icon: Users,
      color: 'blue'
    },
    {
      title: 'Revenue',
      value: '$45,231',
      change: '+8% from last month',
      icon: DollarSign,
      color: 'green'
    },
    {
      title: 'Orders',
      value: '1,423',
      change: '+23% from last month',
      icon: ShoppingBag,
      color: 'yellow'
    },
    {
      title: 'Growth',
      value: '15.3%',
      change: '+2% from last month',
      icon: TrendingUp,
      color: 'purple'
    }
  ]

  return (
    <div className="p-6 space-y-6">
      {/* Header */}
      <div className="mb-8">
        <h1 className="text-3xl font-bold text-gray-900 dark:text-white mb-2">
          Welcome to {config.siteName}
        </h1>
        <p className="text-gray-600 dark:text-gray-400">
          Here's what's happening with your admin dashboard today.
        </p>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {stats.map((stat, index) => (
          <StatCard key={index} {...stat} />
        ))}
      </div>

      {/* Main Content Grid */}
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Recent Activity */}
        <div className="lg:col-span-2 card p-6">
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
              Recent Activity
            </h2>
            <Activity className="w-5 h-5 text-gray-400" />
          </div>
          <div className="space-y-4">
            {[
              { action: 'New user registered', time: '2 minutes ago', type: 'user' },
              { action: 'Order #1234 completed', time: '5 minutes ago', type: 'order' },
              { action: 'Database backup completed', time: '1 hour ago', type: 'system' },
              { action: 'Server maintenance scheduled', time: '2 hours ago', type: 'system' },
              { action: 'New feature deployed', time: '3 hours ago', type: 'deployment' }
            ].map((activity, index) => (
              <div key={index} className="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div className={`w-2 h-2 rounded-full ${
                  activity.type === 'user' ? 'bg-blue-500' :
                  activity.type === 'order' ? 'bg-green-500' :
                  activity.type === 'system' ? 'bg-yellow-500' :
                  'bg-purple-500'
                }`} />
                <div className="flex-1">
                  <p className="text-sm text-gray-900 dark:text-white">{activity.action}</p>
                  <p className="text-xs text-gray-500 dark:text-gray-400">{activity.time}</p>
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* System Status */}
        <div className="card p-6">
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
              System Status
            </h2>
            <Server className="w-5 h-5 text-gray-400" />
          </div>
          <div className="space-y-4">
            {[
              { name: 'Database', status: 'Healthy', icon: Database, color: 'green' },
              { name: 'API Server', status: 'Healthy', icon: Server, color: 'green' },
              { name: 'CDN', status: 'Healthy', icon: Globe, color: 'green' },
              { name: 'Cache', status: 'Warning', icon: Activity, color: 'yellow' }
            ].map((service, index) => (
              <div key={index} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                <div className="flex items-center space-x-3">
                  <service.icon className="w-4 h-4 text-gray-400" />
                  <span className="text-sm text-gray-900 dark:text-white">{service.name}</span>
                </div>
                <span className={`text-xs px-2 py-1 rounded-full ${
                  service.color === 'green' 
                    ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400'
                    : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400'
                }`}>
                  {service.status}
                </span>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Config Information */}
      <div className="card p-6">
        <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
          Application Configuration
        </h2>
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <div className="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <p className="text-sm text-gray-600 dark:text-gray-400">Site Name</p>
            <p className="font-medium text-gray-900 dark:text-white">{config.siteName}</p>
          </div>
          <div className="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <p className="text-sm text-gray-600 dark:text-gray-400">Domain</p>
            <p className="font-medium text-gray-900 dark:text-white">{config.domain}</p>
          </div>
          <div className="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <p className="text-sm text-gray-600 dark:text-gray-400">App</p>
            <p className="font-medium text-gray-900 dark:text-white">{config.app}</p>
          </div>
          <div className="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <p className="text-sm text-gray-600 dark:text-gray-400">Environment</p>
            <p className="font-medium text-gray-900 dark:text-white">{config.environment}</p>
          </div>
        </div>
      </div>
    </div>
  )
}

export default Dashboard
