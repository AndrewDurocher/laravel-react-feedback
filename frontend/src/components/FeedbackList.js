import React, { useState, useEffect, useCallback } from 'react';
import axios from 'axios';

const emojiMap = {
  1: '🥲',
  2: '😐',
  3: '🙂',
  4: '😄',
  5: '🤩'
};

function FeedbackList({ refreshTrigger }) {
  const [feedbacks, setFeedbacks] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [selectedRating, setSelectedRating] = useState(null);
  const [pagination, setPagination] = useState({
    currentPage: 1,
    lastPage: 1,
    total: 0
  });

  const fetchFeedbacks = useCallback(async () => {
    setLoading(true);
    try {
      let url = `http://127.0.0.1:8000/api/feedback?page=${pagination.currentPage}`;
      if (selectedRating) {
        url += `&rating=${selectedRating}`;
      }
        
      console.log('Fetching from:', url);
      const response = await axios.get(url);
      console.log('Response data:', response.data);
      
      setFeedbacks(response.data.data);
      setPagination({
        currentPage: response.data.current_page,
        lastPage: response.data.last_page,
        total: response.data.total
      });
      setError(null);
    } catch (err) {
      console.error('Error fetching feedback:', err);
      console.error('Error details:', {
        message: err.message,
        response: err.response?.data,
        status: err.response?.status
      });
      setError('Laravel server is not running. Please start it with: php artisan serve');
    } finally {
      setLoading(false);
    }
  }, [selectedRating, pagination.currentPage]);

  useEffect(() => {
    fetchFeedbacks();
  }, [selectedRating, refreshTrigger, fetchFeedbacks]);

  const handleFilterChange = (rating) => {
    setSelectedRating(rating === selectedRating ? null : rating);
    setPagination(prev => ({ ...prev, currentPage: 1 })); // Reset to first page when filter changes
  };

  const handlePageChange = (newPage) => {
    setPagination(prev => ({ ...prev, currentPage: newPage }));
  };

  const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
  };

  return (
    <div className="bg-white p-6 rounded-lg shadow-md mt-8">
      <div className="flex justify-between items-center mb-6">
        <h2 className="text-2xl font-bold text-green-700">Recent Feedback</h2>
        <div className="flex space-x-2">
          <button 
            onClick={() => setSelectedRating(null)} 
            className={`px-3 py-1 text-sm rounded-full ${selectedRating === null ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'}`}
          >
            All
          </button>
          {[1, 2, 3, 4, 5].map(rating => (
            <button
              key={rating}
              onClick={() => handleFilterChange(rating)}
              className={`px-3 py-1 text-sm rounded-full ${selectedRating === rating ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'}`}
            >
              {emojiMap[rating]}
            </button>
          ))}
        </div>
      </div>

      {loading ? (
        <div className="flex justify-center py-8">
          <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-green-700"></div>
        </div>
      ) : error ? (
        <div className="text-center py-8">
          <p className="text-red-500 mb-2">{error}</p>
          <code className="block mt-2 p-2 bg-gray-100 rounded text-sm font-mono text-gray-700">php artisan serve</code>
        </div>
      ) : feedbacks.length === 0 ? (
        <div className="text-center py-8 text-gray-500">
          <p className="text-lg mb-2">No feedback found.</p>
          <p className="text-sm text-gray-400">To load sample data, please run:</p>
          <code className="block mt-2 p-2 bg-gray-100 rounded text-sm font-mono text-gray-700">php artisan db:seed</code>
        </div>
      ) : (
        <>
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                  <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                  <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                  <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {feedbacks.map(feedback => (
                  <tr key={feedback.id}>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="text-sm font-medium text-gray-900">{feedback.customer_name}</div>
                    </td>
                    <td className="px-6 py-4">
                      <div className="text-sm text-gray-900">{feedback.message}</div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="text-xl">
                        {emojiMap[feedback.rating]}
                      </div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {formatDate(feedback.created_at)}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>

          {/* Pagination Controls */}
          <div className="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            <div className="flex flex-1 justify-between sm:hidden">
              <button
                onClick={() => handlePageChange(pagination.currentPage - 1)}
                disabled={pagination.currentPage === 1}
                className={`relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 ${
                  pagination.currentPage === 1 
                    ? 'opacity-50 cursor-not-allowed' 
                    : 'hover:bg-gray-50'
                }`}
              >
                Previous
              </button>
              <button
                onClick={() => handlePageChange(pagination.currentPage + 1)}
                disabled={pagination.currentPage === pagination.lastPage}
                className={`relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 ${
                  pagination.currentPage === pagination.lastPage 
                    ? 'opacity-50 cursor-not-allowed' 
                    : 'hover:bg-gray-50'
                }`}
              >
                Next
              </button>
            </div>
            <div className="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
              <div>
                <p className="text-sm text-gray-700">
                  Showing page <span className="font-medium">{pagination.currentPage}</span> of{' '}
                  <span className="font-medium">{pagination.lastPage}</span> ({pagination.total} total items)
                </p>
              </div>
              <div>
                <nav className="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                  <button
                    onClick={() => handlePageChange(pagination.currentPage - 1)}
                    disabled={pagination.currentPage === 1}
                    className={`relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 ${
                      pagination.currentPage === 1 
                        ? 'opacity-50 cursor-not-allowed' 
                        : 'hover:bg-gray-50'
                    }`}
                  >
                    <span className="sr-only">Previous</span>
                    <svg className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fillRule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clipRule="evenodd" />
                    </svg>
                  </button>
                  <button
                    onClick={() => handlePageChange(pagination.currentPage + 1)}
                    disabled={pagination.currentPage === pagination.lastPage}
                    className={`relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 ${
                      pagination.currentPage === pagination.lastPage 
                        ? 'opacity-50 cursor-not-allowed' 
                        : 'hover:bg-gray-50'
                    }`}
                  >
                    <span className="sr-only">Next</span>
                    <svg className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fillRule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clipRule="evenodd" />
                    </svg>
                  </button>
                </nav>
              </div>
            </div>
          </div>
        </>
      )}
    </div>
  );
}

export default FeedbackList;