import { useState } from 'react';
import './App.css';
import FeedbackForm from './components/FeedbackForm';
import FeedbackList from './components/FeedbackList';

function App() {
  const [refreshKey, setRefreshKey] = useState(0);

  const handleFeedbackSubmitted = () => {
    setRefreshKey(prevKey => prevKey + 1);
  };

  return (
    <div className="min-h-screen bg-gray-100">
      <header className="bg-green-600 shadow">
        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <h1 className="text-3xl font-bold text-white">🐸 LilYPad POS - Customer Feedback</h1>
        </div>
      </header>

      <main>
        <div className="py-12">
          <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <FeedbackForm onFeedbackSubmitted={handleFeedbackSubmitted} />
              </div>
              <div>
                <FeedbackList refreshTrigger={refreshKey} />
              </div>
            </div>
          </div>
        </div>
      </main>

      <footer className="bg-white">
        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-gray-500">
          &copy; {new Date().getFullYear()} Andrew C.B. Durocher. All rights reserved.
        </div>
      </footer>
    </div>
  );
}

export default App;
