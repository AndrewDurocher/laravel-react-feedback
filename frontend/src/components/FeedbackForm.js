import React, { useState } from 'react';
import axios from 'axios';

const emojiMap = {
  1: '🥲',
  2: '😐',
  3: '🙂',
  4: '😄',
  5: '🤩'
};

function FeedbackForm({ onFeedbackSubmitted }) {
  const [formData, setFormData] = useState({
    customer_name: '',
    message: '',
    rating: 3
  });
  const [errors, setErrors] = useState({});
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [submitSuccess, setSubmitSuccess] = useState(false);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
    
    // Clear the error for this field when it's changed
    if (errors[name]) {
      setErrors({
        ...errors,
        [name]: null
      });
    }
  };

  const handleRatingChange = (rating) => {
    setFormData({
      ...formData,
      rating
    });
    
    // Clear the rating error when changed
    if (errors.rating) {
      setErrors({
        ...errors,
        rating: null
      });
    }
  };

  const validateForm = () => {
    const newErrors = {};
    if (!formData.customer_name.trim()) {
      newErrors.customer_name = 'Name is required';
    }
    if (!formData.message.trim()) {
      newErrors.message = 'Message is required';
    }
    if (!formData.rating) {
      newErrors.rating = 'Rating is required';
    }
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    if (!validateForm()) {
      return;
    }
    
    setIsSubmitting(true);
    
    try {
      await axios.post('http://127.0.0.1:8000/api/feedback', formData);
      setFormData({
        customer_name: '',
        message: '',
        rating: 3
      });
      setSubmitSuccess(true);
      
      // Call the parent callback to refresh feedback list
      if (onFeedbackSubmitted) {
        onFeedbackSubmitted();
      }
      
      // Reset success message after 3 seconds
      setTimeout(() => {
        setSubmitSuccess(false);
      }, 3000);
    } catch (error) {
      console.error('Error submitting feedback:', error.response?.data || error.message);
      if (error.response?.data?.errors) {
        setErrors(error.response.data.errors);
      }
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className="bg-white p-6 rounded-lg shadow-md">
      <h2 className="text-2xl font-bold mb-4 text-green-700">Submit Your Feedback</h2>
      
      {submitSuccess && (
        <div className="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
          Feedback submitted successfully!
        </div>
      )}
      
      <form onSubmit={handleSubmit} className="space-y-4">
        <div>
          <label htmlFor="customer_name" className="block text-sm font-medium text-gray-700">Your Name</label>
          <input
            type="text"
            id="customer_name"
            name="customer_name"
            value={formData.customer_name}
            onChange={handleChange}
            className="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
          />
          {errors.customer_name && <span className="text-red-500 text-sm">{errors.customer_name}</span>}
        </div>
        
        <div>
          <label htmlFor="message" className="block text-sm font-medium text-gray-700">Your Message</label>
          <textarea
            id="message"
            name="message"
            rows="4"
            value={formData.message}
            onChange={handleChange}
            className="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
          ></textarea>
          {errors.message && <span className="text-red-500 text-sm">{errors.message}</span>}
        </div>
        
        <div>
          <label className="block text-sm font-medium text-gray-700">How happy are you with this app?</label>
          <div className="flex items-center space-x-4 mt-2">
            {[1, 2, 3, 4, 5].map(rating => (
              <button
                key={rating}
                type="button"
                onClick={() => handleRatingChange(rating)}
                className={`flex flex-col items-center p-2 rounded-full focus:outline-none ${formData.rating === rating ? 'ring-2 ring-green-500 ring-offset-2' : ''}`}
              >
                <span className="text-3xl">{emojiMap[rating]}</span>
                <span className="text-xs mt-1">{rating}</span>
              </button>
            ))}
          </div>
          {errors.rating && <span className="text-red-500 text-sm">{errors.rating}</span>}
        </div>
        
        <div>
          <button
            type="submit"
            disabled={isSubmitting}
            className="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50"
          >
            {isSubmitting ? 'Submitting...' : 'Submit Feedback'}
          </button>
        </div>
      </form>
    </div>
  );
}

export default FeedbackForm;